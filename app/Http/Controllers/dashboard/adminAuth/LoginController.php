<?php

namespace App\Http\Controllers\dashboard\adminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';


    public function showLoginForm()
    {
        return view('adminauth.login');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->role_id != 1) {
            $this->guard()->logout();

            $request->session()->invalidate();

            return redirect('/admin-login')->with(['error' => 'You are not admin']);
        }


    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/admin-login');
    }
}


