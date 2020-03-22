<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Exists;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        // $request->validate([
        //     'identity' => 'exists:mysql.users,email',
        //     'password' => 'required|string',
        //     ]);  
        
        $login = $this->username();

        $exists = User::where(
                'email', 
                $request->input('identity')
            )
            ->orWhere(
                'nickname', 
                $request->input('identity')
            )
            ->exists();


        $request->validate([
            'identity' => [
                'required',
                function (string $field, $value, $reject) use ($exists) {
                    if (! $exists) {
                        $reject(
                            _('wrong credentionals')
                        );
                    }
                }
            ],
            'password' => 'required|string',
        ]);
    }
        
        

}
