<?php

namespace Modules\Auth\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
    public function index()
    {
        $pageTitle = 'Kích hoạt tài khoản';
        return view('auth::clients.verify', compact('pageTitle'));
    }
}
