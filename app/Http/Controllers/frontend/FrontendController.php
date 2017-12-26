<?php

namespace App\Http\Controllers\frontend;

use App\Category;
use App\Comment;
use App\Conversation;
use App\ConversationMember;
use App\Follow;
use App\FollowPost;
use App\Like;
use App\Message;
use App\Notification;
use App\Post;
use App\PostReport;
use App\RecentSearch;
use App\Tag;
use App\User;
use App\UserCategory;
use App\UserDetail;
use App\UserReport;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use App\Slim;

class FrontendController extends Controller
{
    public function __construct()
    {
        view()->share('search_suggestion', $this->popular_post());
        view()->share('all_users', $this->allUsers());
        view()->share('all_conversation', $this->allConversation());
    }

    public function recentSearches()
    {
        $list = RecentSearch::where('user_id', Auth::id())->take(5)->get();
        return $list;
    }

    public function allConversation()
    {
        return Conversation::orderBy('id', 'desc')->get();
    }

    public function allNotification()
    {
        $notifications = Notification::where('status', 1)->get();
        return $notifications;
    }

    public function popular_post()
    {
        $posts = Post::where('status', 1)->get();
        return $posts;
    }

    public function allUsers()
    {
        return User::where('status', 1)->whereIn('role_id', [3, 4])->orderBy('name', 'asc')->get();
    }

    public function home()
    {
        $dt = Carbon::now()->toDateTimeString();
        $data = array();
        $post1 = Post::where('status', 1)
            ->where('expire_date', '>', $dt)
            ->where(function ($q) {
                $q->whereHas('user.followers', function ($query) {
                    $query->where('followed_by', Auth::id());
                })
                    ->orWhereHas('user.posts.follows', function ($z) {
                        $z->where('user_id', Auth::id());
                    });
            })->with('user', 'comments.user:id,name', 'likes.user:id,name')
            ->orderBy('expire_date', 'asc')
            ->get();
        if ($post1->count() < 10) {
            $postIds = $post1->pluck('id');
            $take = 10 - $post1->count();
            $post2 = Post::where('status', 1)
                ->where('expire_date', '>', $dt)
                ->whereNotIn('id', $postIds)
                ->with('user', 'comments.user:id,name', 'likes.user:id,name')
                ->orderBy('expire_date', 'asc')
                ->take($take)
                ->get();
            $posts = $post1->merge($post2);
        } else {
            $posts = $post1;
        }
        $data['posts'] = $posts;
        return view('frontend.home.index')->with($data);
    }

    public function notifications()
    {
        /*$notifications = Notification::where('noti_to', Auth::id())->where('status', 1)->update(['status' => 0]);
        $notifications = Notification::where('noti_to', Auth::id())->get();*/
        $data = array();
//        $data['all_notifications'] = Notification::select('*', DB::raw('count(*) as total, MAX(created_at) AS created_at'))->where('noti_to', Auth::id())->orderBy('created_at', 'desc')->groupBy('noti_activity', 'purpose_id')->get();
        $data['all_notifications'] = Notification::where('noti_to', Auth::id())->orderBy('created_at', 'desc')->get();
//        $data['all_notifications'] = Notification::select(DB::raw('SELECT * FROM notifications WHERE created_at IN (SELECT MAX(created_at) FROM notifications GROUP BY noti_activity,purpose_id)'))->get();
//        $data['all_notifications'] = Notification::select('*', DB::raw('count(*) as total, MAX(created_at) AS created_at'))->where('noti_to', Auth::id())->orderBy('created_at','desc')->groupBy('noti_activity','purpose_id')->get();
//        $data['all_notifications'] = Notification::whereRaw('id IN (select MAX(id) FROM notifications GROUP BY noti_activity,purpose_id)')->get();
//        dd($data['all_notifications']);
        return view('frontend.notifications')->with($data);
    }

    /*public function notifications()
    {
        $data = array();
        $data['all_notifications'] = Notification::where('noti_to', Auth::id())
            ->orderBy('created_at')
            ->get()
            ->sortBy('created_at')
            ->groupBy('noti_activity')
            ->map(function ($events) {
                return $events
                    ->groupBy('purpose_id')
                   ;
            })
            ->sortBy('created_at')
         ;
        $my_objects = $data['all_notifications']->sort(function($a) {
           dd($a);
        });


        dd($data['all_notifications'],$my_objects);
        return view('frontend.notifications')->with($data);
    }*/

    public function notificationDetalis($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->status = 0;
            $notification->save();
            if ($notification->noti_for == 2) {
                if ($notification->post->status != 1 || $notification->post->expire_date < Carbon::now()->toDateTimeString()) {
                    return back()->with('errMessage', 'This Post Is Corrently Inactive');
                }
//                return redirect(route('frontend.home') . "#post_id_$notification->purpose_id");
                return redirect(route('frontend.post.details', $notification->purpose_id));
            } elseif ($notification->noti_for == 3) {
                return redirect()->route('frontend.user.profile', $notification->purpose_id);
            }
        }else{
            return back()->with('errMessage', 'This Notification Is Corrently Inactive');
        }
    }

    public function postDetails($id)
    {
//        Notification::where('noti_to', Auth::id())->where('noti_for', 2)->where('purpose_id', $id)->where('status', 1)->update(['status' => 0]);
        $data = array();
        $data['post'] = Post::findOrFail($id);
        return view('frontend.home.postdetails')->with($data);
    }

    public function postDetailsById($id)
    {
        if (Auth::check()) {
            return redirect()->route('frontend.post.details', $id);
        }
        $data = array();
        $data['post'] = Post::findOrFail($id);
        return view('frontend.publicaccess.unauthpostdetails')->with($data);
    }

    public function postDetailsLike(Request $request)
    {
        $postexist = Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($postexist) {
            $postexist->delete();
        } else {
            $like = new Like();
            $like->post_id = $request->post_id;
            $like->user_id = Auth::id();
            $like->save();
        }
        $post = Post::findOrFail($request->post_id);
        return Response::json(View::make('frontend.home.render.postdetailsrender', array('post' => $post))->render());
    }

    public function postDetailsFollow(Request $request)
    {
        $followexist = Follow::where('user_id', $request->user_id)->where('followed_by', Auth::id())->first();
        if ($followexist) {
            $followexist->delete();
        } else {
            $follow = new Follow();
            $follow->user_id = $request->user_id;
            $follow->followed_by = Auth::id();
            $follow->save();
        }
        $post = Post::findOrFail($request->post_id);
        return Response::json(View::make('frontend.home.render.postdetailsrender', array('post' => $post))->render());
    }

    public function postComment(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $request->validate([
            'comment' => 'required'
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $id;
        $comment->comment = $request->comment;
        if ($comment->save()) {
            if ($post->user->id != Auth::id()) {
                $notification = Notification::where('user_id', Auth::id())->where('noti_for', 2)->where('noti_activity', 2)->where('purpose_id', $id)->first();
                if ($notification) {
                    $notification->created_at = Carbon::now();
                    $notification->save();
                } else {
                    $notification = new Notification();
                    $notification->user_id = Auth::id();
                    $notification->noti_text = 'commented on your post';
                    $notification->noti_for = 2;
                    $notification->noti_activity = 2;
                    $notification->purpose_id = $id;
                    $notification->noti_to = $post->user->id;
                    $notification->save();
                }
            }
            if ($request->ajax()) {
                $data = array();
                $data['content'] = View::make('frontend.home.render.commentCount', array('post' => $post))->render();
                $data['comment'] = View::make('frontend.home.render.comment.single-comment', array('comment' => $comment))->render();
                return Response::json($data);
            }
            return back()->with('succsMsg', 'Successfully Commented');

        }
    }

    public function myProfile()
    {
//        Notification::where('noti_to', Auth::id())->where('noti_for', 3)->where('purpose_id', Auth::id())->where('status', 1)->update(['status' => 0]);
        $data = array();
        $data['posts'] = Post::where('user_id', Auth::id())
            ->orderBy('expire_date', 'asc')
            ->with('user', 'comments.user:id,name', 'likes.user:id,name')
            ->get();
        $data['user'] = Auth::user();
        return view('frontend.users.profile')->with($data);

    }

    public function userProfile($id)
    {
        $data = array();
        $data['posts'] = Post::where('status', 1)
            ->where('user_id', $id)
            ->orderBy('expire_date', 'asc')
            ->with('user', 'comments.user:id,name', 'likes.user:id,name')
            ->get();
        $data['user'] = User::findOrFail($id);
        return view('frontend.users.profile')->with($data);
    }

    public function editMyProfile()
    {
        return view('frontend.users.edit');

    }

    public function updateMyProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'business_description' => 'required',
//            'old_password' => 'required',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        if ($request->new_password) {
            $request->validate([
                'new_password' => 'string|min:6|same:confirm_password',
            ]);
            $user->password = bcrypt($request->new_password);
        }
        if ($user->save()) {
            $userDetails = UserDetail::where('user_id', $user->id)->first();
            if (!$userDetails) {
                $userDetails = new UserDetail();
                $userDetails->user_id = $user->id;
            }
            /*if ($request->profile_picture) {
                $image = Slim::getImages('profile_picture')[0];

                if (isset($image['output']['data'])) {
                    $name = $image['output']['name'];

                    $data = $image['output']['data'];

                    $path = base_path('content-dir/profile_picture');

                    $file = Slim::saveFile($data, $name, $path);

                    $userDetails->profile_picture = $file['name'];
                    $userDetails->save();
                }
            }*/
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filenam = time() . $file->getClientOriginalName();
                $filename = str_replace(' ', '', $filenam);
                $destinationPath = base_path('content-dir/profile_picture');
                $img = Image::make($file);
                $img->save($destinationPath . '/' . $filename);
                $userDetails->profile_picture = $filename;
            }
            $userDetails->business_description = $request->business_description;

            if ($userDetails->save()) {
                return redirect(route('frontend.my.profile'))->with('succMessage', 'Your Profile Updated Successfully');
            }else{
                return back()->with('errMessage', 'Your Profile Details Can not Updated Successfully');
            }
        }else{
            return back()->with('errMessage', 'Your Profile Can not Updated Successfully');
        }


//        $old_password = $request->old_password;
//        $match = Auth::user()->getAuthPassword();
//
//        if (Hash::check($old_password, $match)) {
//            $user = User::find(Auth::id());
//            $user->name = $request->name;
//            if ($request->new_password) {
//                $request->validate([
//                    'new_password' => 'string|min:6|same:confirm_password',
//                ]);
//                $user->password = bcrypt($request->new_password);
//            }
//            if ($user->save()) {
//                $userDetails = UserDetail::where('user_id', $user->id)->first();
//                /*if ($request->profile_picture) {
//                    $image = Slim::getImages('profile_picture')[0];
//
//                    if (isset($image['output']['data'])) {
//                        $name = $image['output']['name'];
//
//                        $data = $image['output']['data'];
//
//                        $path = base_path('content-dir/profile_picture');
//
//                        $file = Slim::saveFile($data, $name, $path);
//
//                        $userDetails->profile_picture = $file['name'];
//                        $userDetails->save();
//                    }
//                }*/
//                if ($request->hasFile('profile_picture')) {
//                    $file = $request->file('profile_picture');
//                    $filename = time() . $file->getClientOriginalName();
//                    $destinationPath = base_path('content-dir/profile_picture');
//                    $img = Image::make($file);
//                    $img->save($destinationPath . '/' . $filename);
//                    $userDetails->profile_picture = $filename;
//                    $userDetails->save();
//                }
//            }
//            return redirect(route('frontend.my.profile'))->with('succsMsg', 'Your Profile Updated Successfully');
//        } else {
//            return back()->with('errMsg', 'You Entered Wrong Password');
//        }

    }

    public function explore()
    {
        $data = array();
        $data['posts'] = Post::orderBy('id', 'desc')->with('user:id,name', 'comments.user:id,name', 'likes.user:id,name')->get()->where('expire_date', '>', Carbon::now()->toDateTimeString());
        return view('frontend.publicaccess.explore')->with($data);
    }

    public function homeExplore()
    {
        $dt = Carbon::now()->toDateTimeString();
        $data = array();
        $data['posts'] = Post::where('status', 1)->orderBy('id', 'desc')->with('user', 'comments.user:id,name', 'likes.user:id,name')->get()->where('expire_date', '>', $dt);
        return view('frontend.home.index')->with($data);
    }

    public function newProUserRegistrationForm()
    {
        $data = array();
        if (Auth::user()->role_id == 4) {
            return redirect()->route('frontend.home')->with('errMsg', 'You Are Already Pro User');
        }
        $data['categories'] = UserCategory::all();
        return view('frontend.auth.new_pro_user_register')->with($data);
    }

    public function newProUserRegistration(Request $request)
    {
        if ($request->proUserCheck == "yes") {
            $request->validate([
                'proUserCheck' => 'required',
                'category_name' => 'required',
                'business_description' => 'required',
            ]);
            if (Auth::user()->role_id == 4) {
                return redirect()->route('frontend.home')->with('errMessage', 'You Are Already Pro User');
            } else {
                $user = User::findOrFail(Auth::id());
                $user->role_id = 4;
                if ($user->save()) {
                    $userDetalis = UserDetail::where('user_id', Auth::id())->first();
                    if (!$userDetalis) {
                        $userDetalis = new UserDetail();
                        $userDetalis->user_id = Auth::id();
                    }
                    $userDetalis->category_name = $request->category_name;
                    $userDetalis->business_description = $request->business_description;
                    $userDetalis->save();
                }
            }
        }
        Auth::logout();
        return redirect('/login')->with('succMessage', 'Login using your new created account');

    }

    public function proUserRegistrationForm()
    {
        $data = array();
        if (Auth::user()->role_id == 4) {
            return redirect()->route('frontend.home')->with('errMsg', 'You Are Already Pro User');
        }
        $data['categories'] = UserCategory::all();
        return view('frontend.auth.pro_user_register')->with($data);
    }

    public
    function proUserRegistration(Request $request)
    {
        if ($request->proUserCheck == "no") {
            return redirect()->route('frontend.home');
        }
        $request->validate([
            'proUserCheck' => 'required',
            'category_name' => 'required',
            'business_description' => 'required',
        ]);
        if (Auth::user()->role_id == 4) {
            return redirect()->route('frontend.home')->with('errMsg', 'You Are Already Pro User');
        } else {
            $user = User::findOrFail(Auth::id());
            $user->role_id = 4;
            if ($user->save()) {
                $userDetalis = UserDetail::where('user_id', Auth::id())->first();
                if (!$userDetalis) {
                    $userDetalis = new UserDetail();
                    $userDetalis->user_id = Auth::id();
                }
                $userDetalis->category_name = $request->category_name;
                $userDetalis->business_description = $request->business_description;
                if ($userDetalis->save()) {
                    return redirect()->route('frontend.home')->with('succsMsg', 'You Register as a Pro User');
                } else {
                    return redirect()->route('frontend.home')->with('errMsg', 'User Details Can not save');
                }
            } else {
                return redirect()->route('frontend.home')->with('errMsg', 'Try Again');
            }
        }
    }

    public
    function newLaunch()
    {
//        dd(Auth::user()->followers);
        $data = array();
        $data['categories'] = Category::where('status', 1)->get();
        return view('frontend.home.new_post')->with($data);
    }

    public
    function saveLaunch(Request $request)
    {
        $request->validate([
            'post_details' => 'required|max:255',
            'category_id' => 'required',
            'expire_date' => 'required',
            'image' => 'required',
        ]);

        $post = new Post();
        /*if ($request->image) {
            // Pass Slim's getImages the name of your file input, and since we only care about one image, postfix it with the first array key
            $image = Slim::getImages('image')[0];

            // Grab the ouput data (data modified after Slim has done its thing)
            if (isset($image['output']['data'])) {
                // Original file name
                $name = $image['output']['name'];

                // Base64 of the image
                $data = $image['output']['data'];

                // Server path
                $path = base_path('content-dir/posts/images');

                // Save the file to the server
                $file = Slim::saveFile($data, $name, $path);
                $post->image = $file['name'];
            }
        }*/
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filenam = time() . $file->getClientOriginalName();
            $filename = str_replace(' ', '', $filenam);
            $destinationPath = base_path('content-dir/posts/images');
            $img = Image::make($file);
            $img->save($destinationPath . '/' . $filename);
            $post->image = $filename;
        }

//        $post->post_title = $request->post_title;
        $post->post_details = $request->post_details;
        $post->category_id = $request->category_id;
        $post->expire_date = Carbon::parse($request->expire_date)->toDateTimeString();
        $post->user_id = Auth::id();
        if ($post->save()) {
            foreach (Auth::user()->followers as $follower) {
                $notification = new Notification();
                $notification->user_id = Auth::id();
                $notification->noti_for = 2;
                $notification->noti_activity = 5;
                $notification->purpose_id = $post->id;
                $notification->noti_to = $follower->followed_by;
                $notification->save();
            }
            $tags = array();
            $matches = null;
            if (preg_match_all('/(?!\b)(#\w+\b)/', $request->post_details, $matches)) {
                $tags = collect(array_first($matches))->unique();

            }
            /*$tags = array();
            $matches = null;
            if (preg_match_all('/(?!\b)(#\w+\b)/', $request->post_details, $matches)) {
                $tags = array_first($matches)->collect()->unique;

            }*/
            foreach ($tags as $tag) {
                $htag = new Tag();
                $htag->post_id = $post->id;
                $htag->tag = $tag;
                $htag->save();
            }
            return redirect()->route('frontend.home')->with('succMessage', 'Post Created Successfully');
        } else {
            return back()->with('errMessage', "Post Can't Create");
        }
    }

    /*like a post*/
    public function likePost(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $data = array();
        $postexist = Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($postexist) {
            $postexist->delete();
            if ($post->user->id != Auth::id()) {
                $notification = Notification::where('noti_for', 2)->where('noti_activity', 1)->where('purpose_id', $request->post_id)->where('status', 1)->first();
                if ($notification) {
                    if ($notification->noti_text == 0) {
                        $notification->delete();
                    } else {
                        if ($post->likes) {
                            $notification->user_id = $post->likes->last()->user_id;
                            $notification->noti_text = $post->likes->count() - 1;
                            $notification->created_at = Carbon::now();
                            $notification->save();
                        }

                    }

                    /*$decrement = $notification->noti_text;
                    if ($decrement <= 0) {
                        if ($notification->user_id == Auth::id()) {
                            $notification->delete();
                        }
                    } else {
                        $l = Like::where('post_id', $request->post_id)->orderBy('id', 'desc')->first();
                        $notification->user_id = $l->user_id;
                        $notification->noti_text = $decrement - 1;
                        $notification->save();
                    }*/

                }
            }
            $data['status'] = 0;
//            return response()->json(['status' => 0, 'message' => 'Post Unliked Successfully']);
        } else {
            $like = new Like();
            $like->post_id = $request->post_id;
            $like->user_id = Auth::id();
            if ($like->save()) {
                $data['status'] = 1;
                if ($post->user->id != Auth::id()) {
                    $notification = Notification::where('noti_for', 2)->where('noti_activity', 1)->where('purpose_id', $request->post_id)->first();
                    if ($notification) {
                        $notification->created_at = Carbon::now();
                        $notification->noti_text = $post->likes->count() - 1;
                        $notification->status = 1;
                    } else {
                        $notification = new Notification();
                        $notification->noti_for = 2;
                        $notification->noti_activity = 1;
                        $notification->purpose_id = $request->post_id;
                        $notification->noti_to = $post->user->id;
                    }
                    $notification->user_id = Auth::id();
                    $notification->save();

                }
            }
//            return response()->json(['status' => 1, 'message' => 'Post Liked Successfully']);
        }
        $data['content'] = View::make('frontend.home.render.likeCount', array('post' => $post))->render();
        return Response::json($data);
    }

    /*My Liked*/
    public function likedByMe()
    {
        $data = array();
        $data['posts'] = Like::where('user_id', Auth::id())->orderBy('id', 'desc')->get()->where('post.expire_date', '>', Carbon::now()->toDateTimeString());
        return view('frontend.followings.followings')->with($data);
    }


    /*like liked post*/

    public function likedLike(Request $request)
    {
        $postexist = Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($postexist) {
            $postexist->delete();
//            return response()->json(['status' => 0, 'message' => 'Post Unliked Successfully']);
        } else {
            $like = new Like();
            $like->post_id = $request->post_id;
            $like->user_id = Auth::id();
            $like->save();
//            return response()->json(['status' => 1, 'message' => 'Post Liked Successfully']);
        }
        $post = Post::findOrFail($request->post_id);
        return Response::json(View::make('frontend.followings.render.single', array('post' => $post))->render());
    }

    /*liked follow*/

    public function likedFollow(Request $request)
    {
        $followexist = Follow::where('user_id', $request->user_id)->where('followed_by', Auth::id())->first();
        if ($followexist) {
            $followexist->delete();
        } else {
            $follow = new Follow();
            $follow->user_id = $request->user_id;
            $follow->followed_by = Auth::id();
            $follow->save();
        }
        $posts = Like::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return Response::json(View::make('frontend.followings.render.followingrender', array('posts' => $posts))->render());
    }

    /*Follow user*/
    public function followUser(Request $request)
    {
        $data = array();
        $followexist = Follow::where('user_id', $request->user_id)->where('followed_by', Auth::id())->first();
        if ($followexist) {
            if ($followexist->delete()) {
                $notification = Notification::where('user_id', Auth::id())->where('noti_for', 3)->where('noti_activity', 3)->where('purpose_id', $request->user_id)->first();
                if ($notification) {
                    $notification->delete();
                }
                $data['status'] = 0;
            }
        } else {
            $follow = new Follow();
            $follow->user_id = $request->user_id;
            $follow->followed_by = Auth::id();
            if ($follow->save()) {
                $data['status'] = 1;
                if ($request->user_id != Auth::id()) {
                    $notification = new Notification();
                    $notification->user_id = Auth::id();
                    $notification->noti_text = 'is following you';
                    $notification->noti_for = 3;
                    $notification->noti_activity = 3;
                    $notification->purpose_id = $request->user_id;
                    $notification->noti_to = $request->user_id;
                    $notification->save();
                }

            }
        }
        return Response::json($data);
        /*$posts = Post::orderBy('id', 'desc')->with('user', 'comments.user:id,name', 'likes.user:id,name')->get()->where('expire_date', '>', Carbon::now()->toDateTimeString());
        return Response::json(View::make('frontend.home.render.indexrender', array('posts' => $posts))->render());*/
    }

    /*my followed*/
    public function followedByMe()
    {
        $data = array();
        $data['brands'] = Follow::where('followed_by', Auth::id())->orderBy('id', 'desc')->get();
//        dd($data['brands']);
        return view('frontend.my-list.my_list')->with($data);
    }

    /*Search*/
    public function search(Request $request)
    {
        $data = array();
        $search_key = $request->q;
//        dd($search_key);
        $htag = starts_with($search_key, '#');
        if ($htag) {
            $data['posts'] = Post::whereHas('tags', function ($q) use ($search_key) {
                $q->where('tag', $search_key);
            })->where('status', 1)->with('tags')->where('expire_date', '>', Carbon::now()->toDateTimeString())->orderBy('id', 'desc')->get();
            $data['search_key'] = $search_key;
            return view('frontend.search.tag')->with($data);
        } else {
            $searchExist = RecentSearch::where('user_id', Auth::id())->where('search_text', $search_key)->first();
            if ($searchExist) {
                $searchExist->created_at = Carbon::now();
                $searchExist->save();
            } else {
                $recentSearch = new RecentSearch();
                $recentSearch->user_id = Auth::id();
                $recentSearch->search_text = $search_key;
                $recentSearch->save();
            }

            $matchbrand = "MATCH (post_details) AGAINST ('" . $search_key . "' IN BOOLEAN MODE)";
            $data['posts'] = Post::whereRaw($matchbrand)->where('status', 1)->orderBy('id', 'desc')->get()->where('expire_date', '>', Carbon::now()->toDateTimeString());
//            return view('frontend.search.search')->with($data);
            $data['brands'] = User::Where('name', 'like', '%' . $search_key . '%')->where('status', 1)->orderBy('id', 'desc')->get();
            $data['search_key'] = $search_key;
            return view('frontend.search.search')->with($data);
        }
    }

    /*public function search(Request $request)
    {
        $data = array();
        $search_key = $request->q;
        if ($request->searchType == 1) {
            $matchbrand = "MATCH (post_details) AGAINST ('" . $search_key . "' IN BOOLEAN MODE)";
            $data['posts'] = Post::whereRaw($matchbrand)->get();
            return view('frontend.search.search')->with($data);
        } elseif ($request->searchType == 2) {
            $data['brands'] = User::Where('name', 'like', '%' . $search_key . '%')->get();
            return view('frontend.usersearch.usersearch')->with($data);
        }

    }*/

    public function searchLike(Request $request)
    {
        $postexist = Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($postexist) {
            $postexist->delete();
//            return response()->json(['status' => 0, 'message' => 'Post Unliked Successfully']);
        } else {
            $like = new Like();
            $like->post_id = $request->post_id;
            $like->user_id = Auth::id();
            $like->save();
//            return response()->json(['status' => 1, 'message' => 'Post Liked Successfully']);
        }
        $post = Post::findOrFail($request->post_id);
        return Response::json(View::make('frontend.search.searchrender', array('post' => $post))->render());
    }

    public function followUserById($id)
    {
        $followexist = Follow::where('user_id', $id)->where('followed_by', Auth::id())->first();
        if ($followexist) {
            $followexist->delete();
        } else {
            $follow = new Follow();
            $follow->user_id = $id;
            $follow->followed_by = Auth::id();
            $follow->save();
        }
        return back();
    }

    /*render post*/
    public function renderPost()
    {
        $posts = Post::orderBy('id', 'desc')->with('user', 'comments.user:id,name', 'likes.user:id,name')->get()->where('expire_date', '>', Carbon::now()->toDateTimeString());
        return Response::json(View::make('frontend.home.render.indexrender', array('posts' => $posts))->render());
    }

    /*test message*/
    public function chatHistory(Request $request)
    {
//        Message::where('to_id', $request->to_id)->where('status', 1)->update(['status' => 0]);
        return Response::json($this->chatRoomRender($request->to_id));
//        return $this->chatHistoryRender($request->to_id);
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->from_id = Auth::id();
        $message->to_id = $request->to_id;
        $message->message = $request->message;
        if ($message->save()) {
            return Response::json($this->chatRoomRender($request->to_id));
//            return $this->chatHistoryRender($request->to_id);
        }
    }

    /*Save conversation name*/
    public function saveConversation(Request $request)
    {
        $conversation = new Conversation();
        $conversation->name = $request->name;
        $conversation->user_id = Auth::id();
        $conversation->save();
        foreach ($request->user_id as $user_id) {
            $member = new ConversationMember();
            $member->conversation_id = $conversation->id;
            $member->user_id = $user_id;
            $member->save();
        }
        if ($request->ajax()) {
            $data = array();
            $data['content'] = View::make('frontend.includes.sidebar.chatcontent.conversationList', array('user' => $conversation))->render();
            $data['chatHistory'] = $this->chatRoomRender($conversation->id);
            return Response::json($data);
        }
        return back();
    }

    public function chatRoomRender($target_id)
    {
        $messages = Message::where('to_id', $target_id)->get();
        return View::make('frontend.includes.sidebar.chatcontent.chat-room', array('messages' => $messages, 'user' => Conversation::find($target_id)))->render();
    }

    public function chatHistoryRender($target_id)
    {
        $user_id = Auth::id();
        $messages = Message::where(function ($query) use ($target_id) {
            $query->orwhere('from_id', '=', $target_id)
                ->orwhere('to_id', '=', $target_id);
        })
            ->where(function ($query) use ($user_id) {
                $query->orwhere('from_id', '=', $user_id)
                    ->orwhere('to_id', '=', $user_id);
            })->get();
//        return $messages;
//        return view('frontend.includes.sidebar.chatcontent.chat-content', array('messages' => $messages))->render();
        return Response::json(View::make('frontend.includes.sidebar.chatcontent.chat-content', array('messages' => $messages, 'user' => User::find($target_id)))->render());
    }

    public function reportPost(Request $request)
    {
        $data = array();
        $postReport = new PostReport();
        $postReport->user_id = Auth::id();
        $postReport->post_id = $request->post_id;
        $postReport->report_description = $request->report_description;
        if ($postReport->save()) {
            $data['status'] = 1;
            return Response::json($data);
            /*$post = Post::findOrFail($request->post_id);
            return Response::json(View::make('frontend.home.render.single', array('post' => $post))->render());*/
        }
    }

    public function reportPostDetails(Request $request)
    {
        $postReport = new PostReport();
        $postReport->user_id = Auth::id();
        $postReport->post_id = $request->post_id;
        $postReport->report_description = $request->report_description;
        if ($postReport->save()) {
            $post = Post::findOrFail($request->post_id);
            return Response::json(View::make('frontend.home.render.postdetailsrender', array('post' => $post))->render());
        }
    }

    public function reportUser(Request $request, $id)
    {
        $userReport = new UserReport();
        $userReport->user_id = $id;
        $userReport->reported_by = Auth::id();
        $userReport->report_description = $request->report_description;
        if ($userReport->save()) {
            return back()->with('succMessage', 'User Successfully Reported');
        } else {
            return back()->with('errMessage', 'Something Wrong');
        }
    }

    public function filter(Request $request)
    {
        $f1 = $request->f1;
        $f2 = $request->f2;
        $f3 = $request->f3;
        $f4 = $request->f4;
        $data = array();
        $data['f1'] = $request->f1;
        $data['f2'] = $request->f2;
        $data['f3'] = $request->f3;
        $data['f4'] = $request->f4;
        $data['cancel'] = 1;
        $posts = Post::where('status', 1)->where('expire_date', '>', Carbon::now()->toDateTimeString())->with('user', 'comments.user:id,name', 'likes.user:id,name');
        if ($f1) {
            if ($f1 == 'all') {
                $data['posts'] = $posts->orderBy('expire_date', 'asc')->get();
            } else {
                $data['posts'] = $posts->inRandomOrder()->get();
            }
        } else {
            if ($f2) {
                if ($f2 == 'around_me') {
                    if (Auth::user()->location) {
                        $q = $posts->whereHas('user', function ($query) {
                            $query->where('location', 'like', '%' . Auth::user()->location . '%');
                        });
                    } else {
                        return back()->with('errMessage', 'You Location is not Selected yet');
                    }

                } elseif ($f2 == 'nationality') {
                    if (Auth::user()->location) {
                        $q = $posts->whereHas('user', function ($query) {
                            $query->where('location', 'like', Auth::user()->location);
                        });
                    } else {
                        return back()->with('errMessage', 'You Location is not Selected yet');
                    }
                } elseif ($f2 == 'worldwide') {
                    $q = $posts->inRandomOrder();
                }
            }
            if ($f3) {
                $today = Carbon::today();
                if ($f3 == 'today') {
                    $startDate = $today->startOfDay()->toDateTimeString();
                    $endDate = $today->endOfDay()->toDateTimeString();
//                    $data['posts'] = $posts->whereDate('created_at', DB::raw('CURDATE()'));
                } elseif ($f3 == 'week') {
                    $startDate = $today->startOfWeek()->toDateTimeString();
                    $endDate = $today->endOfWeek()->toDateTimeString();
                } elseif ($f3 == 'month') {
                    $startDate = $today->startOfMonth()->toDateTimeString();
                    $endDate = $today->endOfMonth()->toDateTimeString();
                } elseif ($f3 == 'year') {
                    $startDate = $today->startOfYear()->toDateTimeString();
                    $endDate = $today->endOfYear()->toDateTimeString();
                }
                $q = @$q ? $q->whereBetween('created_at', [$startDate, $endDate]) : $posts->whereBetween('created_at', [$startDate, $endDate]);
            }
            if ($f4) {
                if ($f4 == 'closest') {
                    $q = @$q ? $q->orderBy('expire_date', 'asc') : $posts->orderBy('expire_date', 'asc');
                } elseif ($f4 == 'latest') {
                    $q = @$q ? $q->orderBy('expire_date', 'desc') : $posts->orderBy('expire_date', 'desc');
                }

            }
            $data['posts'] = $q->get();
        }

        return view('frontend.home.index')->with($data);
    }

    public function datalist(Request $request)
    {
        $data = array();
        $data['search_sugstns'] = RecentSearch::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        $data['users'] = User::where('status', 1)->whereIn('role_id', [3, 4])->get();
        $data['posts'] = Post::where('status', 1)->get();
        return Response::json(View::make('frontend.includes.header.searchlist')->with($data)->render());
    }

    public function test()
    {
        /*$posts = Post::orderBy('id', 'desc')->skip(5)->take(2)->get();
        dd($posts);
        return 'this is test method';*/

    }

    public function test1()
    {
        $now = Carbon::now();
        $posts = Post::where('status', 1)->where('expire_date', '>', $now->toDateTimeString())->get();
        foreach ($posts as $post) {
            $expired_date = new \Carbon\Carbon($post->expire_date);
            $diffInDays = $expired_date->diffInDays($now);
            if ($diffInDays >= 7) {
                foreach ($post->follows as $follow) {
                    $notification = Notification::where('noti_to', $follow->user_id)->where('noti_activity', 6)->where('noti_for', 2)->where('purpose_id', $post->id)->first();
                    if (!$notification) {
                        $followNotification = new Notification();
                        $followNotification->user_id = $post->user->id;
                        $followNotification->noti_for = 2;
                        $followNotification->noti_activity = 6;
                        $followNotification->purpose_id = $post->id;
                        $followNotification->noti_to = $follow->user_id;
                        $followNotification->save();
                    }
                }
            }
        }
    }

    public function loadComments(Request $request)
    {
        $data = array();
        $comments = Comment::where('post_id', $request->post_id)->orderBy('id', 'desc')->skip($request->skip)->take(10)->get()->reverse();
        if ($request->ajax()) {
            $data['content'] = View::make('frontend.home.render.comment.comments', array('comments' => $comments))->render();
            $data['count'] = $comments->count();
            return Response::json($data);
        }
    }

    public function followPost(Request $request)
    {
        $post_id = $request->user_id;
        $post = Post::find($post_id);
        $data = array();
        $followexist = FollowPost::where('post_id', $post_id)->where('user_id', Auth::id())->first();
        if ($followexist) {
            $followexist->delete();
            if ($post->user->id != Auth::id()) {
                $notification = Notification::where('noti_for', 2)->where('noti_activity', 4)->where('purpose_id', $post_id)->where('status', 1)->first();
                if ($notification) {
                    if ($notification->noti_text == 0) {
                        $notification->delete();
                    } else {
                        if ($post->follows) {
                            $notification->user_id = $post->follows->last()->user_id;
                            $notification->noti_text = $post->follows->count() - 1;
                            $notification->created_at = Carbon::now();
                            $notification->save();
                        }

                    }
                }
            }
            $followNotification = Notification::where('noti_for', 2)->where('noti_activity', 6)->where('purpose_id', $post_id)->where('noti_to', Auth::id())->where('status', 1)->first();
            if ($followNotification) {
                $followNotification->delete();
            }
            $followBeforeDayNotification = Notification::where('noti_for', 2)->where('noti_activity', 7)->where('purpose_id', $post_id)->where('noti_to', Auth::id())->where('status', 1)->first();
            if ($followBeforeDayNotification) {
                $followBeforeDayNotification->delete();
            }
            $data['status'] = 0;
        } else {
            $follow = new FollowPost();
            $follow->post_id = $post_id;
            $follow->user_id = Auth::id();
            if ($follow->save()) {
                $data['status'] = 1;
                if ($post->user->id != Auth::id()) {
                    $notification = Notification::where('noti_for', 2)->where('noti_activity', 4)->where('purpose_id', $post_id)->first();
                    if ($notification) {
                        $notification->created_at = Carbon::now();
                        $notification->noti_text = $post->follows->count() - 1;
                        $notification->status = 1;
                    } else {
                        $notification = new Notification();
                        $notification->noti_for = 2;
                        $notification->noti_activity = 4;
                        $notification->purpose_id = $post_id;
                        $notification->noti_to = $post->user->id;
                    }
                    $notification->user_id = Auth::id();
                    $notification->save();

                }
                /*$followNotification = new Notification();
                $followNotification->user_id = $post->user->id;
                $followNotification->noti_for = 2;
                $followNotification->noti_activity = 6;
                $followNotification->purpose_id = $post_id;
                $followNotification->noti_to = Auth::id();
                $followNotification->save();
                $followBeforeDayNotification = new Notification();
                $followBeforeDayNotification->user_id = $post->user->id;
                $followBeforeDayNotification->noti_for = 2;
                $followBeforeDayNotification->noti_activity = 7;
                $followBeforeDayNotification->purpose_id = $post_id;
                $followBeforeDayNotification->noti_to = Auth::id();
                $followBeforeDayNotification->save();*/
            }
        }
        return Response::json($data);
    }

    public function registrationCheckEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return 'false';
        } else {
            return 'true';
        }

    }
}