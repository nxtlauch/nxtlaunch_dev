<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiStatusTrait;
use App\UserDetail;
use App\UserInterest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserDetailController extends Controller
{
    use ApiStatusTrait;
    public $successStatus = 200;
    public $failureStatus = 100;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'address' => 'required',
//            'birth_date'=> 'required',
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }

        $userDetail = UserDetail::where('user_id', Auth::id())->first();
        if (empty($userDetail)) {
            $userDetail = new UserDetail();
        }
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . $file->getClientOriginalName();
            $destinationPath = base_path('content-dir/profile_picture');
            $img = Image::make($file);
            $img->save($destinationPath . '/' . $filename);
            $userDetail->profile_picture = $filename;
        }

        $userDetail->profile_picture = $request->profile_picture;
        $userDetail->user_id = Auth::id();
        $userDetail->address = $request->address;
        if ($userDetail->save()) {
            $response['userdetails_id'] = $userDetail->id;
            $response['message'] = "User Details Updated Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "User Details can't Updated";
            return $this->failureApiResponse($response);
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
        $userDetail = UserDetail::find($id);
        if ($userDetail) {
            $response['userDetail'] = $userDetail;
            $response['message'] = "User Details Render";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "User Details not Found";
            return $this->failureApiResponse($response);
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
        /*$validator = Validator::make($request->all(), [
            'address' => 'required',
//            'birth_date'=> 'required',
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        $userDetail = UserDetail::where('user_id', Auth::id())->first();
        if (empty($userDetail)) {
            $userDetail = new UserDetail();
        }
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . $file->getClientOriginalName();
            $destinationPath = base_path('content-dir/profile_picture');
            $img = Image::make($file);
            $img->save($destinationPath . '/' . $filename);
            $userDetail->profile_picture = $filename;
        }

        $userDetail->profile_picture = $request->profile_picture;
        $userDetail->user_id = Auth::id();
        $userDetail->address = $request->address;
        if ($userDetail->save()) {
            $response['post_id'] = $userDetail->id;
            $response['message'] = "Post Created Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Post Doesn't Created";
            return $this->failureApiResponse($response);
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        /*$userDetail = Post::find($id);
        if ($userDetail->delete()) {
            $response['message'] = "Post Deleted Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Post Doesn't Deleted";
            return $this->failureApiResponse($response);
        }*/
    }

    public function proUserRegistration(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'business_description' => 'required',
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }

        $userDetail = UserDetail::where('user_id', Auth::id())->first();
        if (empty($userDetail)) {
            $userDetail = new UserDetail();
        }
        $userDetail->user_id = Auth::id();
        $userDetail->category_name = $request->category_name;
        $userDetail->business_description = $request->business_description;

        if ($userDetail->save()) {
            $response['userdetails_id'] = $userDetail->id;
            $response['message'] = "Pro user Registered Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Pro user can't Registered ";
            return $this->failureApiResponse($response);
        }
    }

    public function saveUserInterest(Request $request){
        $validator = Validator::make($request->all(), [
            'interests' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }
        foreach ($request->interests as $interest) {
            $category = new UserInterest();
            $category->user_id = Auth::id();
            $category->category_id = $interest;
            $category->save();
        }
        $response['message'] = "User interest saved successfully";
        return $this->successApiResponse($response);

    }
}
