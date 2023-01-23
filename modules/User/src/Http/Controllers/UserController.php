<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $pageTitle = 'Quản lý người dùng';
        return view('user::lists', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Thêm người dùng';
        return view('user::add', compact('pageTitle'));
    }
}