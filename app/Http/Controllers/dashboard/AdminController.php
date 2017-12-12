<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use App\Post;
use App\PostReport;
use App\Slim;
use App\User;
use App\UserDetail;
use App\UserReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    /*Admin Dashboard*/
    public function dashboard()
    {
        $data = array();
        $data['users'] = User::where('status', 1)->whereIn('role_id', [3, 4])->orderBy('id', 'desc')->get();
        $data['posts'] = Post::where('status', 1)->orderBy('id', 'desc')->with('user:id,name')->get();
        return view('dashboard.dashboard')->with($data);
    }

    /*Show All User in admin dashboard*/
    public function users()
    {
        $data = array();
        $data['users'] = User::where('status', 1)->whereIn('role_id', [3, 4])->orderBy('id', 'desc')->withCount('followers')->get();
        return view('users.users')->with($data);
    }

    /*User edit form in admin dashboard*/
    public function editUser($id)
    {
        $data = array();
        $data['user'] = User::with('userDetails')->findOrFail($id);
        return view('users.edit')->with($data);
    }

    /*User Update in admin dashboard*/
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'category_name' => 'required',
            'business_description' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($user->save()) {
            $userDetails = UserDetail::where('user_id', $user->id)->first();
            if (!$userDetails) {
                dd($userDetails);
                $userDetails = new UserDetail();
                $userDetails->user_id = $user->id;
            }
            $userDetails->category_name = $request->category_name;
            $userDetails->business_description = $request->business_description;

            /*if ($request->profile_picture) {
                // Pass Slim's getImages the name of your file input, and since we only care about one image, postfix it with the first array key
                $image = Slim::getImages('profile_picture')[0];

                // Grab the ouput data (data modified after Slim has done its thing)
                if (isset($image['output']['data'])) {
                    // Original file name
                    $name = $image['output']['name'];

                    // Base64 of the image
                    $data = $image['output']['data'];

                    // Server path
                    $path = base_path('content-dir/profile_picture');

                    // Save the file to the server
                    $file = Slim::saveFile($data, $name, $path);

                    $userDetails->profile_picture = $file['name'];
                }
            }*/

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = time() . $file->getClientOriginalName();
                $destinationPath = base_path('content-dir/profile_picture');
                $img = Image::make($file);
                $img->save($destinationPath . '/' . $filename);
                $userDetails->profile_picture = $filename;
            }
            if ($userDetails->save()) {
                return redirect()->route('admin.users')->with('succsMsg', 'User Updated Successfully');
            } else {
                return 'Error in user update';
            }

        } else {
            return back()->with('errMsg', 'Error');
        }
    }

    /*Delete User*/
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return back()->with('succMessage', 'User Deleted Successfully');
        }
    }

    /*Suspend User*/
    public function suspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        if ($user->save()) {
            return back()->with('succMessage', 'User Suspended Successfully');
        }
    }

    /*View all posts in admin dashboard*/
    public function posts()
    {
        $data = array();
        $data['posts'] = Post::where('status', 1)->orderBy('id', 'desc')->with('user:id,name')->get();
        return view('posts.posts')->with($data);
    }

    /*Post edit form in admin dashboard*/
    public function postEdit($id)
    {
        $data = array();
        $data['post'] = Post::withCount('comments', 'likes', 'shares')->findOrFail($id);
        return view('posts.edit')->with($data);
    }

    /*Post update in admin dashboard*/
    public function postUpdate(Request $request, $id)
    {
        $request->validate([
            'post_details' => 'required',
        ]);
        $post = Post::find($id);
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
            $filename = time() . $file->getClientOriginalName();
            $destinationPath = base_path('content-dir/posts/images');
            $img = Image::make($file);
            $img->save($destinationPath . '/' . $filename);
            $post->image = $filename;
        }
//        $post->post_title = $request->post_title;
        $post->post_details = $request->post_details;
        if ($post->save()) {
            return redirect()->route('admin.posts')->with('succsMsg', 'Post Updated Successfully');
        } else {
            return redirect()->route('admin.posts')->with('errMsg', 'Post can not updated');
        }
    }

    /*Delete Post*/
    public function deletePost($id)
    {
        $user = Post::findOrFail($id);
        if ($user->delete()) {
            return back()->with('succMessage', 'Post Deleted Successfully');
        }
    }

    /*Suspend Post*/
    public function suspendPost($id)
    {
        $user = Post::findOrFail($id);
        $user->status = 0;
        if ($user->save()) {
            return back()->with('succMessage', 'Post Suspended Successfully');
        }
    }

    /*categories */
    public function categories()
    {
        $data = array();
        $data['categories'] = Category::all();
        return view('categories.categories')->with($data);
    }

    /*Inser Category*/
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        if ($category->save()) {
            return back()->with('succMessage', 'Category Created Successfully');
        } else {
            return back()->with('errMessage', 'Category can not Create');
        }
    }

    /*Activate/Deactivate Category*/
    public function changeCategoryStatus($id)
    {
        $category = Category::findOrFail($id);
        if ($category->status == 1) {
            $category->status = 0;
            $message = 'Category Deactivate Successfully';
        } else {
            $category->status = 1;
            $message = 'Category Activate Successfully';
        }
        if ($category->save()) {
            return back()->with('succMessage', $message);
        } else {
            return back()->with('errMessage', 'Category Status Unchanged');
        }
    }

    /*Admin Report Posts*/
    public function postReports()
    {
        $data = array();
        $data['postReports'] = PostReport::orderBy('id', 'desc')->get();
        return view('reports.post_reports')->with($data);
    }

    /*Detail Post report by Id*/
    public function detailPostReport($id)
    {
        $data = array();
        $data['postReport'] = PostReport::find($id);
        if (empty($data['postReport'])) {
            return redirect()->route('admin.post.reports')->with('ErrMsg', 'This data is not available in our database');
        }
        return view('reports.post_report_details')->with($data);
    }

    /*Admin REport Delete*/
    public function deleteReport($id)
    {
        $postReport = PostReport::find($id);
        if ($postReport->delete()) {
            return redirect()->route('admin.post.reports')->with('succMessage', 'Post Report Deleted Successfully');
        }
    }

    /*Report details Delete User*/
    public function reportDeleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return redirect()->route('admin.post.reports')->with('succMessage', 'User Deleted Successfully');
        }
    }

    public function reportSuspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        if ($user->save()) {
            return redirect()->route('admin.post.reports')->with('succMessage', 'User Suspended Successfully');
        }
    }

    public function reportSuspendPost($id)
    {
        $user = Post::findOrFail($id);
        $user->status = 0;
        if ($user->save()) {
            return redirect()->route('admin.post.reports')->with('succMessage', 'Post Suspended Successfully');
        }
    }

    /*Admin user Report*/
    public function userReports()
    {
        $data = array();
        $data['users'] = UserReport::all();
        return view('reports.user_reports')->with($data);
    }

    public function userReportsDetails($id)
    {
        $data = array();
        $data['user'] = UserReport::find($id);
        return view('reports.user_report_details')->with($data);
    }

    public function deleteUserReport($id)
    {
        $user = UserReport::findOrFail($id);
        if ($user->delete()) {
            return redirect()->route('admin.report.users')->with('succMessage', 'User Report Deleted Successfully');
        }
    }

    public function userReportDeleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return redirect()->route('admin.report.users')->with('succMessage', 'User Deleted Successfully');
        }
    }

    public function userReportSuspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        if ($user->save()) {
            return redirect()->route('admin.report.users')->with('succMessage', 'User Suspended Successfully');
        }
    }
    /*End User Report*/
    /*Admin User Search*/
    public function userSearch(Request $request)
    {
        $search_key = $request->q;
        $data = array();
        $data['users'] = User::where(function ($q) use ($search_key) {
            $q->where('name', 'like', "%$search_key%")
                ->orWhere('email', 'like', "%$search_key%");
        })->where('status', 1)->whereIn('role_id', [3, 4])->orderBy('id', 'desc')->withCount('followers')->get();
        return view('users.users')->with($data);
    }

    /*Admin Post Search*/
    public function postSearch(Request $request)
    {
        $data = array();
        $search_key = $request->q;
        $data['posts'] = Post::Where('post_details', 'like', "%$search_key%")->where('status', 1)->orderBy('id', 'desc')->with('user:id,name')->get();
        return view('posts.posts')->with($data);
    }
}
