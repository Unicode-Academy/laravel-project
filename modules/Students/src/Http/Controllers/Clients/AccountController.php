<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Students\src\Http\Requests\Clients\PasswordRequest;
use Modules\Students\src\Http\Requests\Clients\StudentRequest;
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

    public function updateProfile(StudentRequest $request)
    {
        $id = Auth::guard('students')->user()->id;
        $status = $this->studentRepository->update($id, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return ['success' => $status];
    }

    public function myCourses()
    {
        $pageTitle = 'Khóa học của tôi';
        $pageName = 'Khóa học của tôi';

        $studentId = Auth::guard('students')->user()->id;
        $courses = $this->studentRepository->getCourses($studentId);

        return view('students::clients.my-courses', compact('pageTitle', 'pageName', 'courses'));
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

    public function updatePassword(PasswordRequest $request)
    {
        $id = Auth::guard('students')->user()->id;
        $status = $this->studentRepository->setPassword($request->password, $id);
        if (!$status) {
            $message = __('students::messages.update.failure');
        } else {
            $message = __('students::messages.update.success');
        }
        return back()->with('msg', $message)->with('msgType', $status ? 'success' : 'danger');
    }
}
