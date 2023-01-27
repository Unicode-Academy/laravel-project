<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
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

    public function store(UserRequest $request)
    {
        $this->userRepository->create([
            'name'=> $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('msg', __('user::messages.success'));
    }
}