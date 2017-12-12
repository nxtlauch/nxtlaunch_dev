<?php

namespace App\Http\Controllers\frontend;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $existing_user = User::where('email', $user->email)->first();
        if (!$existing_user) {
            $authUser = $this->findOrCreateUser($user);
            $filename = time() . $user->id.'.jpg';
            $destinationPath = base_path('content-dir/profile_picture/');
            $shahin = file_get_contents($user->avatar_original);
            file_put_contents($destinationPath . $filename, $shahin);
            $userDetails = new UserDetail();
            $userDetails->user_id = $authUser->id;
            $userDetails->profile_picture = $filename;
            $userDetails->save();
        } else {
            $authUser = User::where('provider_id', $user->id)->first();
            if (!$authUser) {
                $existing_user->provider = 'Facebook';
                $existing_user->provider_id = $user->id;
                $existing_user->save();
            }
        }

        Auth::login($authUser, true);
        return redirect('/');
    }

    public function findOrCreateUser($user)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => 'Facebook',
            'provider_id' => $user->id
        ]);
    }
}
