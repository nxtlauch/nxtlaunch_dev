<?php
/**
 * Created by PhpStorm.
 * User: Thowhidur Rahman
 * Date: 12/31/2017
 * Time: 11:36 AM
 */

namespace App\Traits;


use App\DeviceToken;

trait DeviceTokenTrait
{
    public function findDeviceToken($user_id, $device_token)
    {
        return DeviceToken::where('user_id', $user_id)->where('device_token', $device_token)->first();
    }
    public function createDeviceTokenForApi($user_id, $device_token)
    {
        $deviceToken = new DeviceToken();
        $deviceToken->device_token = $device_token;
        $deviceToken->user_id = $user_id;
        $deviceToken->save();
    }


}