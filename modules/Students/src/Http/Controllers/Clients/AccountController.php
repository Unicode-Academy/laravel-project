<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;

class AccountController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentsRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    public function index()
    {
        $pageTitle = 'Tài khoản';
        $pageName = 'Tài khoản';

        return view('students::clients.account', compact('pageTitle', 'pageName'));
    }

    public function profile()
    {
        $pageTitle = 'Thông tin cá nhân';
        $pageName = 'Thông tin cá nhân';

        $student = Auth::guard('students')->user();

        return view('students::clients.profile', compact('pageTitle', 'pageName', 'student'));
    }

    public function myCourses()
    {
        $pageTitle = 'Khóa học của tôi';
        $pageName = 'Khóa học của tôi';

        return view('students::clients.my-courses', compact('pageTitle', 'pageName'));
    }
    public function myOrders()
    {
        $pageTitle = 'Đơn hàng của tôi';
        $pageName = 'Đơn hàng của tôi';

        return view('students::clients.my-orders', compact('pageTitle', 'pageName'));
    }
    public function changePassword()
    {
        $pageTitle = 'Đổi mật khẩu';
        $pageName = 'Đổi mật khẩu';

        return view('students::clients.change-password', compact('pageTitle', 'pageName'));
    }
}
