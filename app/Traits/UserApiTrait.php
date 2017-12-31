<?php
/**
 * Created by PhpStorm.
 * User: Thowhidur Rahman
 * Date: 12/31/2017
 * Time: 11:36 AM
 */

namespace App\Traits;


trait UserApiTrait
{
    public function userProfilePictureNullCheck($user){
        if (@$user->userDetails->profile_picture) {
            $user->profile_picture = $user->userDetails->profile_picture;
        } else {
            $user->profile_picture = "avatar.png";
        }
    }

}