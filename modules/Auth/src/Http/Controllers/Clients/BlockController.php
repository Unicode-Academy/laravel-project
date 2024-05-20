<?php

namespace Modules\Auth\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->status) {
            return redirect()->route('home');
        }
        $pageTitle = 'Tài khoản đã bị khóa';
        return view('auth::clients.block', compact('pageTitle'));
    }
}