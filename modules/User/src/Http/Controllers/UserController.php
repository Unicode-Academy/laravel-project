<?php

namespace Modules\User\src\Http\Controllers;

use Modules\User\src\Models\User;
use App\Http\Controllers\Controller;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->getUsers(2);
        dd($users);

        return view('user::lists');
    }

    public function detail($id)
    {
        return view('user::detail', compact('id'));
    }

    public function create()
    {
        $user = new User();
        $user->name = 'Hoàng An';
        $user->email = 'hoan.ng@gmail.com';
        $user->save();
    }
}