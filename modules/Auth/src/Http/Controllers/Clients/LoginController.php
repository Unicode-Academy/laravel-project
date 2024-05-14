<?php

namespace Modules\Auth\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\src\Http\Requests\LoginRequest;

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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $pageTitle = 'Đăng nhập';
        return view('auth::clients.login', compact('pageTitle'));

    }

    public function login(LoginRequest $request)
    {
        $dataLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $status = Auth::guard('students')->attempt($dataLogin);

        if ($status) {
            return redirect('/');
        }
        return back()->with('msg', 'Email hoặc mật khẩu không chính xác');
    }
}
