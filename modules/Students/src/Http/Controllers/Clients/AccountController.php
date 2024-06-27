<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Orders\src\Repositories\OrdersRepository;
use Modules\Students\src\Http\Requests\Clients\PasswordRequest;
use Modules\Students\src\Http\Requests\Clients\StudentRequest;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class AccountController extends Controller
{
    private $studentRepository;
    private $teacherRepository;
    private $orderRepository;

    public function __construct(StudentsRepositoryInterface $studentRepository, TeacherRepositoryInterface $teacherRepository, OrdersRepository $orderRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->teacherRepository = $teacherRepository;
        $this->orderRepository = $orderRepository;
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

    public function myCourses(Request $request)
    {
        $pageTitle = 'Khóa học của tôi';
        $pageName = 'Khóa học của tôi';

        $filters = [];
        if ($request->teacher_id) {
            $filters['teacher_id'] = $request->teacher_id;
        }

        if ($request->keyword) {
            $filters['keyword'] = $request->keyword;
        }
        $studentId = Auth::guard('students')->user()->id;
        $courses = $this->studentRepository->getCourses($studentId, $filters, config('paginate.account_limit'));
        $teacher = $this->teacherRepository->getTeachers();

        return view('students::clients.my-courses', compact('pageTitle', 'pageName', 'courses', 'teacher'));
    }
    public function myOrders()
    {
        $pageTitle = 'Đơn hàng của tôi';
        $pageName = 'Đơn hàng của tôi';

        $orders = $this->orderRepository->getOrdersByStudent(Auth::guard('students')->user()->id);

        return view('students::clients.my-orders', compact('pageTitle', 'pageName', 'orders'));
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
