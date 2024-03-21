<?php

namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index() {
        $pageTitle = 'Trang chủ';
        return view('home::index', compact('pageTitle'));
    }
}