<?php

namespace Modules\Auth\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Modules\Auth\src\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:students', ['except' => 'logout']);
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

        $status = Auth::guard('students')->attempt($dataLogin, $request->remember == 1 ? true : false);

        if ($status) {
            return redirect('/');
        }
        return back()->with('msg', __('auth::messages.login.failure'));
    }

    public function logout()
    {
        Auth::guard('students')->logout();
        return redirect()->route('home');
    }

    public function showFormForgot()
    {
        $pageTitle = 'Đặt lại mật khẩu';
        return view('auth::clients.forgot', compact('pageTitle'));
    }

    public function handleSendForgotLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['msg' => __('auth::messages.password.sent.success')]);
        }
        return back()->with(['msg' => __('auth::messages.password.sent.failure')]);

    }

    public function showFormReset($token)
    {
        $pageTitle = 'Đặt lại mật khẩu';

        return view('auth::clients.reset', compact('pageTitle', 'token'));
    }
}