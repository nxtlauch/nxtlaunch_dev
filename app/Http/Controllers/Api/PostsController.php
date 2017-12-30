<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Like;
use App\Notification;
use App\Post;
use App\RecentSearch;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public $successStatus = 200;
    public $failureStatus = 100;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dt = Carbon::now()->toDateTimeString();
        $post1 = Post::where('status', 1)
            ->where(function ($q) {
                $q->whereHas('user.followers', function ($query) {
                    $query->where('followed_by', Auth::id());
                })
                    ->orWhereHas('user.posts.follows', function ($z) {
                        $z->where('user_id', Auth::id());
                    });
            })
            ->orderBy('expire_date', 'asc')
            ->with('user', 'comments.user:id,name', 'likes.user:id,name', 'follows')
            ->where('expire_date', '>', $dt)
            ->get();
        if ($post1->count() < 10) {
            $postIds = $post1->pluck('id');
            $take = 10 - $post1->count();
            $post2 = Post::where('status', 1)
                ->orderBy('expire_date', 'asc')
                ->with('user', 'comments.user:id,name', 'likes.user:id,name', 'follows')
                ->where('expire_date', '>', $dt)
                ->whereNotIn('id', $postIds)
                ->take($take)
                ->get();
            $posts = $post1->merge($post2);
        } else {
            $posts = $post1;
        }
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if ($posts->count() > 0) {
            $response['posts'] = $posts;
            $response['message'] = "All Posts Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

        /*$dt = Carbon::now()->toDateTimeString();
        $posts = Post::where('status', 1)->orderBy('id', 'desc')->with('user', 'comments.user:id,name', 'likes.user:id,name')->where('expire_date', '>', $dt)->get();
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if (!empty($posts)) {
            $response['posts'] = $posts;
            $response['message'] = "All Posts Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }*/
    }

    public function unauthHome()
    {
        $dt = Carbon::now()->toDateTimeString();
        $posts = Post::where('status', 1)->orderBy('expire_date', 'asc')->with('user', 'comments.user:id,name', 'likes.user:id,name')->where('expire_date', '>', $dt)->take(10)->get();
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if ($posts->count() > 0) {
            $response['posts'] = $posts;
            $response['message'] = "All Posts Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    public function explore()
    {
        $dt = Carbon::now()->toDateTimeString();
        $posts = Post::where('status', 1)->orderBy('id', 'desc')->with('user', 'comments.user:id,name', 'likes.user:id,name')->where('expire_date', '>', $dt)->get();
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if ($posts->count() > 0) {
            $response['posts'] = $posts;
            $response['message'] = "All Posts Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'post_title' => 'required',
            'post_details' => 'required|max:255',
            'expire_date' => 'required',
            'image' => 'required|max:20000',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        $post = new Post();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $destinationPath = base_path('content-dir/posts/images');
            $img = Image::make($file);
            $img->save($destinationPath . '/' . $filename);
            $post->image = $filename;
        }

//        $post->post_title = $request->post_title;
        $post->post_details = $request->post_details;
        $post->category_id = $request->category_id;
        $post->expire_date = Carbon::create($request->expire_date);
        $post->user_id = Auth::id();
        if ($post->save()) {
            /*notification and tag save*/
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
            foreach ($tags as $tag) {
                $htag = new Tag();
                $htag->post_id = $post->id;
                $htag->tag = $tag;
                $htag->save();
            }
            /*end notification and tag save*/
            $response['post_id'] = $post->id;
            $response['message'] = "Post Created Successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Post Can't Create";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->with(['user', 'comments.user', 'likes.user'])->first();
        if ($post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
            $response['post'] = $post;
            $response['message'] = "Post info Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Post info not Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
//            'post_title' => 'required',
            'post_details' => 'required|max:255',
            'expire_date' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        $post = Post::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $destinationPath = base_path('content-dir/posts/images');
            $img = Image::make($file);
            $img->save($destinationPath . '/' . $filename);
            $post->image = $filename;
        }

//        $post->post_title = $request->post_title;
        $post->post_details = $request->post_details;
        $post->category_id = $request->category_id;
        $post->expire_date = Carbon::create($request->expire_date);
        $post->user_id = Auth::id();
        if ($post->save()) {
            $response['post_id'] = $post->id;
            $response['message'] = "Post Updated Successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Post Doesn't Updated";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($post->delete()) {
                $response['message'] = "Post Deleted Successfully";
                return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
            } else {
                $response['message'] = "Post Doesn't Deleted";
                return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
            }
        } else {
            $response['message'] = "No post available in id $id";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }

    public function my_list()
    {
        $dt = Carbon::now()->toDateTimeString();
        $posts = Post::where('user_id', Auth::id())->where('status', 1)->orderBy('id', 'desc')->with('user', 'comments.user:id,name', 'likes.user:id,name')->where('expire_date', '>', $dt)->get();
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if ($posts->count()) {
            $response['posts'] = $posts;
            $response['message'] = "Authenticated User Posts";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    public function searchPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_key' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $search_key = $request->search_key;
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
        $posts = Post::whereRaw($matchbrand)->where('status', 1)->orderBy('id', 'desc')->where('expire_date', '>', Carbon::now()->toDateTimeString())->with('user', 'comments.user:id,name', 'likes.user:id,name', 'follows')->get();
        if ($posts->count() > 0) {
            foreach ($posts as $post) {
                $user = clone $post->user;
                if (@$user->userDetails->profile_picture) {
                    $post->user->profile_picture = $user->userDetails->profile_picture;
                } else {
                    $post->user->profile_picture = "avatar.png";
                }
                if ($post->likes->contains('user_id', Auth::id())) {
                    $post->liked_by_me = 1;
                } else {
                    $post->liked_by_me = 0;
                }
                if ($post->comments->contains('user_id', Auth::id())) {
                    $post->commented_by_me = 1;
                } else {
                    $post->commented_by_me = 0;
                }
                if ($post->follows->contains('user_id', Auth::id())) {
                    $post->followed_by_me = 1;
                } else {
                    $post->followed_by_me = 0;
                }
            }
            $response['posts'] = $posts;
            $response['message'] = "Search Result";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }

    public function filterPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filter_key' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $filter_key = $request->filter_key;

        $posts = Post::where('status', 1)
            ->where('expire_date', '>', Carbon::now()->toDateTimeString());
        if ($filter_key == 'all') {
            $p = $posts->orderBy('expire_date', 'asc');
        } elseif ($filter_key == 'random') {
            $p = $posts->inRandomOrder();
        } elseif ($filter_key == 'around_me') {
            if (Auth::user()->location) {
                $p = $posts->whereHas('user', function ($query) {
                    $query->where('location', 'like', '%' . Auth::user()->location . '%');
                })->orderBy('id', 'desc');
            } else {
                $response['message'] = 'You Location is not Selected yet';
                return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
            }
        } elseif ($filter_key == 'nationality') {
            if (Auth::user()->location) {
                $p = $posts->whereHas('user', function ($query) {
                    $query->where('location', 'like', '%' . Auth::user()->location . '%');
                })->orderBy('id', 'desc');
            } else {
                $response['message'] = 'You Location is not Selected yet';
                return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
            }
        } elseif ($filter_key == 'worldwide') {
            $p = $posts->inRandomOrder();
        } elseif ($filter_key == 'today') {
            $today = Carbon::today();
            $startDate = $today->startOfDay()->toDateTimeString();
            $endDate = $today->endOfDay()->toDateTimeString();
            $p = $posts->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc');
        } elseif ($filter_key == 'week') {
            $today = Carbon::today();
            $startDate = $today->startOfWeek()->toDateTimeString();
            $endDate = $today->endOfWeek()->toDateTimeString();
            $p = $posts->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc');
        } elseif ($filter_key == 'month') {
            $today = Carbon::today();
            $startDate = $today->startOfMonth()->toDateTimeString();
            $endDate = $today->endOfMonth()->toDateTimeString();
            $p = $posts->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc');
        } elseif ($filter_key == 'year') {
            $today = Carbon::today();
            $startDate = $today->startOfYear()->toDateTimeString();
            $endDate = $today->endOfYear()->toDateTimeString();
            $p = $posts->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc');
        } else {
            $response['message'] = 'Invalid Filter key';
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $filterd_posts = $p->with('user', 'comments.user:id,name', 'likes.user:id,name', 'follows')->get();

        if ($filterd_posts->count() > 0) {
            foreach ($filterd_posts as $post) {
                $user = clone $post->user;
                if (@$user->userDetails->profile_picture) {
                    $post->user->profile_picture = $user->userDetails->profile_picture;
                } else {
                    $post->user->profile_picture = "avatar.png";
                }
                if ($post->likes->contains('user_id', Auth::id())) {
                    $post->liked_by_me = 1;
                } else {
                    $post->liked_by_me = 0;
                }
                if ($post->comments->contains('user_id', Auth::id())) {
                    $post->commented_by_me = 1;
                } else {
                    $post->commented_by_me = 0;
                }
                if ($post->follows->contains('user_id', Auth::id())) {
                    $post->followed_by_me = 1;
                } else {
                    $post->followed_by_me = 0;
                }
            }
            $response['posts'] = $filterd_posts;
            $response['message'] = "Filter Posts Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }

    public function filterPosts(Request $request)
    {




        $f1 = $request->f1;
        $f2 = $request->f2;
        $f3 = $request->f3;
        $f4 = $request->f4;
        if ($f1==null && $f2==null && $f3==null && $f4==null){
            $response['message'] = "No key is selected";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

        $posts = Post::where('status', 1)->where('expire_date', '>', Carbon::now()->toDateTimeString())->with('user', 'comments.user:id,name', 'likes.user:id,name', 'follows');
        if ($f1) {
            if ($f1 == 'all') {
                $filterd_posts = $posts->orderBy('expire_date', 'asc')->get();
            } else {
                $filterd_posts = $posts->inRandomOrder()->get();
            }
        } else {
            if ($f2) {
                if ($f2 == 'around_me') {
                    if (Auth::user()->location) {
                        $q = $posts->whereHas('user', function ($query) {
                            $query->where('location', 'like', '%' . Auth::user()->location . '%');
                        });
                    } else {
                        $response['message'] = "You have no location information";
                        return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
                    }

                } elseif ($f2 == 'nationality') {
                    if (Auth::user()->location) {
                        $q = $posts->whereHas('user', function ($query) {
                            $query->where('location', 'like', Auth::user()->location);
                        });
                    } else {
                        $response['message'] = "You have no location information";
                        return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
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
            $filterd_posts = $q->get();
        }


        if ($filterd_posts->count() > 0) {
            foreach ($filterd_posts as $post) {
                $user = clone $post->user;
                if (@$user->userDetails->profile_picture) {
                    $post->user->profile_picture = $user->userDetails->profile_picture;
                } else {
                    $post->user->profile_picture = "avatar.png";
                }
                if ($post->likes->contains('user_id', Auth::id())) {
                    $post->liked_by_me = 1;
                } else {
                    $post->liked_by_me = 0;
                }
                if ($post->comments->contains('user_id', Auth::id())) {
                    $post->commented_by_me = 1;
                } else {
                    $post->commented_by_me = 0;
                }
                if ($post->follows->contains('user_id', Auth::id())) {
                    $post->followed_by_me = 1;
                } else {
                    $post->followed_by_me = 0;
                }
            }
            $response['posts'] = $filterd_posts;
            $response['message'] = "Filter Posts Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }

    /*private function json($status = NULL, $response = NULL)
    {
        echo json_encode(array('meta' => array('status' => $status), 'response' => $response));
    }*/

    public
    function test()
    {
        return 'dd';
        //return Auth::guard('api')->check();

    }

    public
    function test1()
    {
        $dt = Carbon::now()->toDateTimeString();
        $post1 = Post::where('status', 1)
            ->where(function ($q) {
                $q->whereHas('user.followers', function ($query) {
                    $query->where('followed_by', Auth::id());
                })
                    ->orWhereHas('user.posts.follows', function ($z) {
                        $z->where('user_id', Auth::id());
                    });
            })
            ->orderBy('id', 'desc')
            ->with('user', 'comments.user:id,name', 'likes.user:id,name')
            ->where('expire_date', '>', $dt)
            ->get();
        $postIds = $post1->pluck('id');
        if ($post1->count() < 10) {
            $take = 10 - $post1->count();
            $post2 = Post::where('status', 1)
                ->orderBy('id', 'desc')
                ->with('user', 'comments.user:id,name', 'likes.user:id,name')
                ->where('expire_date', '>', $dt)
                ->whereNotIn('id', $postIds)
                ->take($take)
                ->get();
            $posts = $post1->merge($post2);
        } else {
            $posts = $post1;
        }
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if ($posts->count() > 0) {
            $response['posts'] = $posts;
            $response['message'] = "All Posts Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }

    public
    function myLiked()
    {
        $dt = Carbon::now()->toDateTimeString();
        $posts = Post::where('status', 1)
            ->with('user', 'likes.user:id,name', 'comments.user:id,name')
            ->where('expire_date', '>', $dt)
            ->whereHas('likes', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->get()->sortByDesc('likes.id');
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if (!empty($posts)) {
            $response['posts'] = $posts;
            $response['message'] = "My Likes Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    public
    function postFollowedByMe()
    {
        $dt = Carbon::now()->toDateTimeString();
        $posts = Post::where('status', 1)
            ->with('user', 'likes.user:id,name', 'comments.user:id,name')
            ->where('expire_date', '>', $dt)
            ->whereHas('follows', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->get()->sortByDesc('likes.id');
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', Auth::id())) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', Auth::id())) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', Auth::id())) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
        if ($posts->count() > 0) {
            $response['posts'] = $posts;
            $response['message'] = "My Followed post Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post You followed yet";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}