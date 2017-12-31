<?php
/**
 * Created by PhpStorm.
 * User: Thowhidur Rahman
 * Date: 12/31/2017
 * Time: 11:36 AM
 */

namespace App\Traits;


use Illuminate\Support\Facades\Auth;

trait LikeApiTrait
{
    public function likedPostStructure($likes){
        foreach ($likes as $like) {
            $user = clone $like->post->user;
            if (@$user->userDetails->profile_picture) {
                $like->post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $like->post->user->profile_picture = "avatar.png";
            }
            if ($like->post->likes->contains('user_id',Auth::id())){
                $like->post->liked_by_me=1;
            }else{
                $like->post->liked_by_me=0;
            }
            if ($like->post->comments->contains('user_id',Auth::id())){
                $like->post->commented_by_me=1;
            }else{
                $like->post->commented_by_me=0;
            }
            if ($like->post->follows->contains('user_id',Auth::id())){
                $like->post->followed_by_me=1;
            }else{
                $like->post->followed_by_me=0;
            }
        }
    }

}