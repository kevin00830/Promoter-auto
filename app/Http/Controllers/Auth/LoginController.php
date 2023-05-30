<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;

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
    protected $redirectTo = '/int_web_';

    /**
     * Handle login
     */
    public function login(LoginRequest $request)
    {
        /*$crendentials = [
            'gp_groupname' => $request->login,
            'password' => $request->password
        ];
        if (Auth::attempt($crendentials, $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }*/
        $user = Group::where('gp_groupname', $request->login)->where('gp_temp_psw', $request->password)->first();
        if( $user != null ) {
            Auth::login($user);
            return redirect()->intended($this->redirectPath());
        }
        return redirect()->back()
            ->withInput()
            ->withErrors([
                'login_failed' => 'A credencial está incorreta! Tente novamente.',
            ]);
        // // Check the login type if it is email or username
        // $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // // Merge the login field into the request with either email or username as key
        // $request->merge([
        //     $loginType => $request->input('login')
        // ]);

        // $crendentials = $request->only($loginType, 'password');
        // if (Auth::attempt($crendentials, $request->has('remember'))) {
        //     return redirect()->intended($this->redirectPath());
        // }
        
        // return redirect()->back()
        //     ->withInput()
        //     ->withErrors([
        //         'login_failed' => 'A credencial está incorreta! Tente novamente.',
        //     ]);
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
