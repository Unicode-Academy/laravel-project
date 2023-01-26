<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function data()
    {
        $users = $this->userRepository->getAll();

        $data = [];

        foreach ($users as $user) {
            array_push($data, [
                $user->name,
                $user->email,
                $user->group_id,
                $user->created_at,
                '<a href="#" class="btn btn-warning">Sửa</a>',
                '<a href="#" class="btn btn-danger">Xóa</a>',
            ]);
        }

        $response = [
            'draw' => 1,
            'recordsTotal' => count($users),
            'recordsFiltered' => count($users),
            'data' => $data
        ];

        return $response;
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