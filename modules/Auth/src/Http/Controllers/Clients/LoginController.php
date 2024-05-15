<?php

namespace Modules\Auth\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\src\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:students');
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
       
        $status = Auth::guard('students')->attempt($dataLogin, $request->remember == 1 ? true: false);

        if ($status) {
            return redirect('/');
        }
        return back()->with('msg', 'Email hoặc mật khẩu không chính xác');
    }
}