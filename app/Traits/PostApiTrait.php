<?php
/**
 * Created by PhpStorm.
 * User: Thowhidur Rahman
 * Date: 12/31/2017
 * Time: 11:36 AM
 */

namespace App\Traits;


use Illuminate\Support\Facades\Auth;

trait PostApiTrait
{
    public function postStructure($posts,$user_id){
        foreach ($posts as $post) {
            $user = clone $post->user;
            if (@$user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id', $user_id)) {
                $post->liked_by_me = 1;
            } else {
                $post->liked_by_me = 0;
            }
            if ($post->comments->contains('user_id', $user_id)) {
                $post->commented_by_me = 1;
            } else {
                $post->commented_by_me = 0;
            }
            if ($post->follows->contains('user_id', $user_id)) {
                $post->followed_by_me = 1;
            } else {
                $post->followed_by_me = 0;
            }
        }
    }

    public function singlePostStructure($post){
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

}