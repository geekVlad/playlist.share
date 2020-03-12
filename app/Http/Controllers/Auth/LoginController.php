<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;

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

    //use AuthenticatesUsers;
    use AuthenticatesUsers{
    validateLogin as tvalidateLogin;
}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * Get the login username to be used by the controller.
    *
    * @return string
    */
    public function username()
    {
         $login = request()->input('identity');

         $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
         request()->merge([$field => $login]);

         return $field;
    }

    protected function validateLogin(Request $request)
    {
        $login = $this->username();

        if( !filter_var($login, FILTER_VALIDATE_EMAIL) ){
        $request->validate([
            $login => 'required|string|exists:mysql.users,nickname',
            'password' => 'required|string',
        ]);
    } else {$request->validate([
            $login => 'exists:mysql.users,email',
            'password' => 'required|string',
        ]);
    }
}
        
        

}
