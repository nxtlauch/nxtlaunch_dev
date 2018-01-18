<?php

namespace App\Http\Controllers\frontend;

use App\Category;
use App\Comment;
use App\Conversation;
use App\ConversationMember;
use App\CustomPostNotification;
use App\Follow;
use App\FollowPost;
use App\Like;
use App\Message;
use App\Notification;
use App\Post;
use App\PostCategory;
use App\PostNotificationStatus;
use App\PostReport;
use App\RecentSearch;
use App\Tag;
use App\User;
use App\UserCategory;
use App\UserDetail;
use App\UserInterest;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use App\Slim;

class FrontendController extends Controller
{
    public function __construct()
    {
//        view()->share('search_suggestion', $this->popular_post());
//        view()->share('tag_suggestion', $this->tagSuggestion());
//        view()->share('all_users', $this->allUsers());
//        view()->share('all_conversation', $this->allConversation());
    }

    public function tagSuggestion(){
        $tags = Tag::all()->pluck('tag')->unique();
        return $tags;
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
        $posts = $this->homePosts();
        $data['posts'] = $posts;
        $data['page'] = 1;
        return view('frontend.home.index')->with($data);
    }

    public function notifications()
    {
        $data = array();
        $data['all_notifications'] = Notification::where('noti_to', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('frontend.notifications')->with($data);
    }

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
                return redirect(route('frontend.post.details', $notification->purpose_id));
            } elseif ($notification->noti_for == 3) {
                return redirect()->route('frontend.user.profile', $notification->purpose_id);
            }
        } else {
            return back()->with('errMessage', 'This Notification Is Corrently Inactive');
        }
    }

    public function postDetails($id)
    {
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
            return back()->with('succMessage', 'Successfully Commented');
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
            $userDetails->web_url = $request->web_url;

            if ($userDetails->save()) {
                return redirect(route('frontend.my.profile'))->with('succMessage', 'Your Profile Updated Successfully');
            } else {
                return back()->with('errMessage', 'Your Profile Details Can not Updated Successfully');
            }
        } else {
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
        $data['posts'] = Post::orderBy('id', 'desc')->where('status', 1)->with('user:id,name', 'comments.user:id,name', 'likes.user:id,name')->get()->where('expire_date', '>', Carbon::now()->toDateTimeString());

        return view('frontend.publicaccess.explore')->with($data);
    }

    public function homeExplore()
    {
        $dt = Carbon::now()->toDateTimeString();
        $data = array();
        $data['posts'] = $this->explorePostsGet();
        $data['page'] = 2;
        return view('frontend.home.index')->with($data);
    }

    public function newProUserRegistrationForm()
    {
        $data = array();
        if (Auth::user()->role_id == 4) {
            return redirect()->route('frontend.home')->with('errMessage', 'You Are Already Pro User');
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
            Session::forget('confirm_pro');
        }
//        Auth::logout();
//        return redirect('/login')->with('succMessage', 'Login using your new created account');
        return redirect()->route('new.user.choose.interests');

    }

    public function proUserRegistrationForm()
    {
        $data = array();
        if (Auth::user()->role_id == 4) {
            return redirect()->route('frontend.home')->with('errMessage', 'You Are Already Pro User');
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
                if ($userDetalis->save()) {
                    return redirect()->route('frontend.home')->with('succMessage', 'You Register as a Pro User');
                } else {
                    return redirect()->route('frontend.home')->with('errMessage', 'User Details Can not save');
                }
            } else {
                return redirect()->route('frontend.home')->with('errMessage', 'Try Again');
            }
        }
    }

    public function newUserChooseCategoriesForm()
    {
        $data = array();
        $data['interests'] = Category::where('status',1)->get();
        $data['categories'] = UserCategory::all();
        return view('frontend.auth.new_user_choose_categories')->with($data);
    }

    public function registerProUser()
    {
        Session::put('confirm_pro', 1);
        return redirect(route('register'));
    }

    public function userRegister()
    {
        Session::forget('confirm_pro');
        return redirect(route('register'));
    }

    public function newUserChooseCategories(Request $request)
    {
        $request->validate([
            'interests' => 'required'
        ]);
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
            Session::forget('confirm_pro');
        }
        foreach ($request->interests as $interest) {
            $category = new UserInterest();
            $category->user_id = Auth::id();
            $category->category_id = $interest;
            $category->save();
        }
        return redirect('/');
    }

    public function newLaunch()
    {
//        dd(Auth::user()->followers);
        $data = array();
        $data['categories'] = Category::where('status', 1)->get();
        return view('frontend.home.new_post')->with($data);
    }

    public function editLaunch($id)
    {
        $post = Post::find($id);
        if ($post->user_id == Auth::id()) {
            $data = array();
            $data['categories'] = Category::where('status', 1)->get();
            $data['post'] = $post;
            return view('frontend.home.edit_post')->with($data);
        } else {
            return back()->with('errMessage', "You are not post owner");
        }

    }


    public function updateLaunch(Request $request, $id)
    {
        $request->validate([
            'post_details' => 'required|max:255',
            'category_id' => 'required',
            'expire_date' => 'required',
//            'image' => 'required',
            'link' => 'required|url',
        ]);

        $post = Post::find($id);

        if ($post->user_id == Auth::id()) {
            if ($request->image) {
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
            }


            /*if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filenam = time() . $file->getClientOriginalName();
                $filename = str_replace(' ', '', $filenam);
                $destinationPath = base_path('content-dir/posts/images');
                $img = Image::make($file);
                $img->save($destinationPath . '/' . $filename);
                $post->image = $filename;
            }*/

//        $post->post_title = $request->post_title;
            $post->post_details = $request->post_details;
            $post->link = $request->link;
//            $post->category_id = $request->category_id;
            $post->expire_date = Carbon::parse($request->expire_date)->toDateTimeString();
            if ($post->save()) {
                $categories = $request->category_id;
                $postCategories = $post->postCategories->pluck('category_id');
                $needDelete = $postCategories->diff($categories);
                $deleteCategories = PostCategory::whereIn('category_id', $needDelete)->delete();
                foreach ($categories as $category) {
                    if (!$postCategories->contains($category)) {
                        $newCategory = new PostCategory();
                        $newCategory->category_id = $category;
                        $newCategory->post_id = $post->id;
                        $newCategory->save();
                    }
                }
                return redirect()->route('frontend.my.profile')->with('succMessage', 'Post Updated Successfully');
            } else {
                return back()->with('errMessage', "Post Can't Update");
            }
        } else {
            return back()->with('errMessage', "You are not post owner");
        }

    }


    public
    function saveLaunch(Request $request)
    {
        $request->validate([
            'post_details' => 'required|max:255',
            'category_id' => 'required',
            'expire_date' => 'required',
            'image' => 'required',
            'link' => 'required|url',
        ]);

        $post = new Post();
        if ($request->image) {
            // Pass Slim's getImages the name of your file input, and since we only care about one image, postfix it with the first array key
            $image = Slim::getImages('image')[0];

            // Grab the ouput data (data modified after Slim has done its thing)
            if (isset($image['output']['data'])) {
                // Original file name
                $filenam =$image['output']['name'];
                $name = str_replace(' ', '', $filenam);

                // Base64 of the image
                $data = $image['output']['data'];

                // Server path
                $path = base_path('content-dir/posts/images');

                // Save the file to the server
                $file = Slim::saveFile($data, $name, $path);
                $post->image = $file['name'];
            }
        }
        /*if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filenam = time() . $file->getClientOriginalName();
            $filename = str_replace(' ', '', $filenam);
            $destinationPath = base_path('content-dir/posts/images');
            $img = Image::make($file);
            $img->save($destinationPath . '/' . $filename);
            $post->image = $filename;
        }*/

//        $post->post_title = $request->post_title;
        $post->post_details = $request->post_details;
//        $post->category_id = $request->category_id;
        $post->expire_date = Carbon::parse($request->expire_date)->toDateTimeString();
        $post->user_id = Auth::id();
        $post->link = $request->link;
        if ($post->save()) {
            foreach ($request->category_id as $category_id) {
                $post_categories = new PostCategory();
                $post_categories->post_id = $post->id;
                $post_categories->category_id = $category_id;
                $post_categories->save();
            }
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

    public function deleteLaunch($id)
    {
        $post = Post::find($id);
        if ($post->delete()) {
            Notification::where('noti_for', 2)->where('purpose_id', $id)->delete();
            return back()->with('succMessage', 'Post Deleted Successfully');
        } else {
            return back()->with('errMessage', "Post Can't Delete");
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
        }
        $data['content'] = View::make('frontend.home.render.likeCount', array('post' => $post))->render();
        return Response::json($data);
    }

    /*My Liked*/
    public function likedByMe()
    {
        $data = array();
        $data['posts'] = Like::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('frontend.followings.followings')->with($data);
    }


    /*like liked post*/

    public function likedLike(Request $request)
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
    }

    /*my followed*/
    public function followedByMe()
    {
        $data = array();
        $data['brands'] = Follow::where('followed_by', Auth::id())->orderBy('id', 'desc')->get();
        $data['posts'] = FollowPost::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
//        dd($data['posts']);

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

    public function filterPosts(Request $request)
    {
        $request->validate([
            'time' => 'required',
            'location' => 'required',
        ]);
        $time = $request->time;
        $location = $request->location;
        $data = array();
        $data['time'] = $time;
        $data['location'] = $location;
        $data['page'] = $request->page;
        if ($request->page == 2) {
            $posts = $this->explorePostsGet();
        } elseif ($request->page == 1) {
            $posts = $this->homePosts();
        }

        if ($time != 0) {
            $today = Carbon::today();
            if ($time == 1) {
                $startDate = $today->startOfDay()->toDateTimeString();
                $endDate = $today->endOfDay()->toDateTimeString();
            } elseif ($time == 2) {
                $startDate = $today->startOfWeek()->toDateTimeString();
                $endDate = $today->endOfWeek()->toDateTimeString();
            } elseif ($time == 3) {
                $startDate = $today->startOfMonth()->toDateTimeString();
                $endDate = $today->endOfMonth()->toDateTimeString();
            } elseif ($time == 4) {
                $startDate = $today->startOfYear()->toDateTimeString();
                $endDate = $today->endOfYear()->toDateTimeString();
            }
            $q = $posts->where('expire_date', '>', $startDate)->where('expire_date', '<', $endDate);
        } else {
            $q = $posts;
        }

        if ($location != 0) {
            if (Auth::user()->location) {
                $filterPosts = $q->filter(function ($item) {
                    return strtoupper($item->user->location) == strtoupper(Auth::user()->location);
                });
            } else {
                if ($request->ajax()) {
                    $data['content'] = 'Please add your location in your profile';
                    $data['status'] = 0;
                    return Response::json($data);
                }
                return back()->with('errMessage', "Please add your location first");
            }
        } else {
            $filterPosts = $q;
        }
        if ($request->ajax()) {
            $data['content'] = View::make('frontend.home.render.indexrender', array('posts' => $filterPosts))->render();
            $data['status'] = 1;
            return Response::json($data);
        }
        $data['posts'] = $filterPosts;
        return view('frontend.home.index')->with($data);
    }

    public function datalist(Request $request)
    {
        $data = array();
        $data['search_sugstns'] = RecentSearch::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        $data['users'] = User::where('status', 1)->whereIn('role_id', [3, 4])->get();
        $data['posts'] = Post::where('status', 1)->get();
        $data['tags'] = $this->tagSuggestion();
        $response=array();
        $response['searchSuggestion']=View::make('frontend.includes.header.searchlist')->with($data)->render();
        $response['tagSuggestion']=View::make('frontend.includes.header.taglist')->with($data)->render();
        return Response::json($response);
    }

//    public function test()
//    {
//        $now = Carbon::now();
////        $posts = Post::where('status', 1)->whereHas('follows')->with('follows')->where('expire_date', '>', $now->toDateTimeString())->orderBy('expire_date','asc')->get();
//        $posts = Post::where('status', 1)->whereHas('follows')->with('follows')->whereBetween('expire_date', [$now->toDateTimeString(),$now->addDays(7)->toDateTimeString()])->orderBy('expire_date','asc')->get();
//        dd($posts);
//        if ($posts->count() > 0) {
//            foreach ($posts as $post) {
//                $customNotification = $post->customPostNotification->pluck('user_id');
//                $expired_date = new Carbon($post->expire_date);
//                $diffInDays = $expired_date->diffInDays($now);
//                if ($diffInDays > 7) {
//                    break;
//                }
//                $diffInHours = $expired_date->diffInHours($now);
//                $diffInmin = $expired_date->diffInMinutes($now);
//                foreach ($post->customPostNotification as $notification) {
//                    if ($notification->reminder_before == 1) {
//                        if ($diffInDays <= 7) {
//                            $this->notificationCheck($notification->user_id, 6, $post->id, $post->user->id);
//                        }
//                    } elseif ($notification->reminder_before == 2) {
//                        if ($diffInDays <= 1) {
//                            $this->notificationCheck($notification->user_id, 7, $post->id, $post->user->id);
//                        }
//                    } elseif ($notification->reminder_before == 3) {
//                        if ($diffInHours <= 1) {
//                            $this->notificationCheck($notification->user_id, 8, $post->id, $post->user->id);
//                        }
//                    } elseif ($notification->reminder_before == 4) {
//                        if ($diffInmin <= 20) {
//                            $this->notificationCheck($notification->user_id, 9, $post->id, $post->user->id);
//                        }
//                    }
//                }
//                $allFollows = $post->follows->pluck('user_id');
//                $follows = $allFollows->diff($customNotification);
//                foreach ($follows as $user_id) {
//                    $this->notificationCheck($user_id, 6, $post->id, $post->user->id);
//                }
//            }
//        }
//        /*
//        $activity = 0;
//        $now = Carbon::now();
//        $posts = Post::where('status', 1)->whereHas('follows.user.userSettings')->where('expire_date', '>', $now->toDateTimeString())->get();
//        if ($posts->count() > 0) {
//            foreach ($posts as $post) {
//                $expired_date = new Carbon($post->expire_date);
//                $diffInDays = $expired_date->diffInDays($now);
//                $diffInHours = $expired_date->diffInHours($now);
//                $diffInmin = $expired_date->diffInMinutes($now);
//                if ($post->postNotificationStatus) {
//                    $postNotificationStatus = $post->postNotificationStatus;
//                } else {
//                    $postNotificationStatus = new PostNotificationStatus();
//                    $postNotificationStatus->post_id = $post->id;
//                    $postNotificationStatus->save();
//                }
//
//                foreach ($post->follows as $follow) {
//                    if ($postNotificationStatus->seven_days_reminder == 0 && $diffInDays <= 7 && $follow->user->userSettings->seven_days_reminder == 1) {
//                        $this->notificationCheck($follow->user_id, 6, $post->id, $post->user->id);
//                        $activity = 6;
//                    } elseif ($postNotificationStatus->one_day_reminder == 0 && $diffInDays <= 1 && $follow->user->userSettings->one_day_reminder == 1) {
//                        $this->notificationCheck($follow->user_id, 7, $post->id, $post->user->id);
//                        $activity = 7;
//                    } elseif ($postNotificationStatus->one_hour_reminder == 0 && $diffInHours <= 1 && $follow->user->userSettings->one_hour_reminder == 1) {
//                        $this->notificationCheck($follow->user_id, 8, $post->id, $post->user->id);
//                        $activity = 8;
//                    } elseif ($postNotificationStatus->five_minutes_reminder == 0 && $diffInmin <= 5 && $follow->user->userSettings->five_minutes_reminder == 1) {
//                        $this->notificationCheck($follow->user_id, 9, $post->id, $post->user->id);
//                        $activity = 9;
//                    }
//                }
//                if ($activity != 0) {
//                    if ($activity == 6) {
//                        $postNotificationStatus->seven_days_reminder = 1;
//                    } elseif ($activity == 7) {
//                        $postNotificationStatus->one_day_reminder = 1;
//                    } elseif ($activity == 8) {
//                        $postNotificationStatus->one_hour_reminder = 1;
//                    } elseif ($activity == 9) {
//                        $postNotificationStatus->five_minutes_reminder = 1;
//                    }
//                    $postNotificationStatus->save();
//                }
//            }
//        }*/
//
//    }
//
//    private function notificationCheck($user_id, $noti_activity, $post_id, $post_user_id)
//    {
//        $notification = Notification::where('noti_to', $user_id)->where('noti_activity', $noti_activity)->where('noti_for', 2)->where('purpose_id', $post_id)->first();
//        if (!$notification) {
//            $followNotification = new Notification();
//            $followNotification->user_id = $post_user_id;
//            $followNotification->noti_for = 2;
//            $followNotification->noti_activity = $noti_activity;
//            $followNotification->purpose_id = $post_id;
//            $followNotification->noti_to = $user_id;
//            $followNotification->save();
//        }
//    }

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

    public
    function loadComments(Request $request)
    {
        $data = array();
        $comments = Comment::where('post_id', $request->post_id)->orderBy('id', 'desc')->skip($request->skip)->take(10)->get()->reverse();
        if ($request->ajax()) {
            $data['content'] = View::make('frontend.home.render.comment.comments', array('comments' => $comments))->render();
            $data['count'] = $comments->count();
            return Response::json($data);
        }
    }

    public
    function followPost(Request $request)
    {
        $post_id = $request->user_id;
        $post = Post::find($post_id);
        $data = array();
        $followexist = FollowPost::where('post_id', $post_id)->where('user_id', Auth::id())->first();
        if ($followexist) {
            $followexist->delete();
            if ($post->user->id != Auth::id()) {
                $notification = Notification::where('noti_for', 2)
                    ->where('noti_activity', 4)
                    ->where('purpose_id', $post_id)
                    ->where('status', 1)->first();
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
            $followNotification = Notification::where('noti_for', 2)
                ->where('noti_activity', 6)
                ->where('purpose_id', $post_id)
                ->where('noti_to', Auth::id())
                ->first();
            if ($followNotification) {
                $followNotification->delete();
            }
            $followBeforeDayNotification = Notification::where('noti_for', 2)
                ->where('noti_activity', 7)
                ->where('purpose_id', $post_id)
                ->where('noti_to', Auth::id())
                ->first();
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

    public function notificationExists($notification_for, $notification_activity, $purpose_id)
    {
        $notification = Notification::where('noti_for', $notification_for)
            ->where('noti_activity', $notification_activity)
            ->where('purpose_id', $purpose_id)
            ->first();
        return $notification;
    }

    public function checkCustomNotification(Request $request)
    {
        if ($request->ajax()) {
            $cstm_notification = CustomPostNotification::where('post_id', $request->post_id)
                ->where('user_id', Auth::id())
                ->first();
            $data = array();
            $data['content'] = View::make('frontend.includes.modal.render.notification', array('cstm_notification' => @$cstm_notification, 'post_id' => $request->post_id))->render();
            if ($cstm_notification) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            return Response::json($data);
        }
    }

    public function saveCustomNotification(Request $request)
    {
        if ($request->ajax()) {
            $cstm_notification = CustomPostNotification::where('post_id', $request->post_id)
                ->where('user_id', Auth::id())
                ->first();
            if (!$cstm_notification) {
                $cstm_notification = new CustomPostNotification();
                $cstm_notification->post_id = $request->post_id;
                $cstm_notification->user_id = Auth::id();
            }
            $cstm_notification->reminder_before = $request->reminder_before;
            $cstm_notification->save();
            $data = array();
            $data['status'] = 1;
            return Response::json($data);
        }
    }

    public function homePosts()
    {
        $dt = Carbon::now()->toDateTimeString();
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
        return $posts;
    }

    public function explorePostsGet()
    {
        return $this->explorePosts()->get();
    }

    public function explorePosts()
    {
        return Post::where('status', 1)->where('expire_date', '>', Carbon::now()->toDateTimeString())->orderBy('id', 'desc')->with('user', 'comments.user:id,name', 'likes.user:id,name');
    }
}