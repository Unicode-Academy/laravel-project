<?php

namespace Modules\Students\src\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Students\src\Http\Requests\StudentRequest;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentsRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    public function index()
    {
        $pageTitle = 'Quản lý học viên';

        return view('students::lists', compact('pageTitle'));
    }

    public function data()
    {
        $students = $this->studentRepository->getAllStudents();

        $data = DataTables::of($students)
            ->addColumn('edit', function ($student) {
                return '<a href="' . route('admin.students.edit', $student) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($student) {
                return '<a href="' . route('admin.students.delete', $student) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($student) {
                return Carbon::parse($student->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('status', function ($student) {
                return $student->status ? '<span class="badge bg-success">Kích hoạt</span>': '<span class="badge bg-danger">Chưa kích hoạt</span>';
            })
            ->rawColumns(['edit', 'delete', 'status'])
            ->toJson();
        return $data;
    }

    public function create()
    {
        $pageTitle = 'Thêm học viên';
        return view('students::add', compact('pageTitle'));
    }

    public function store(StudentRequest $request)
    {
        $this->studentRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->route('admin.students.index')->with('msg', __('students::messages.create.success'));
    }

    public function edit($id)
    {
        $student = $this->studentRepository->find($id);

        if (!$student) {
            abort(404);
        }

        $pageTitle = 'Cập nhật học viên';

        return view('students::edit', compact('student', 'pageTitle'));
    }

    public function update(StudentRequest $request, $id)
    {
        $data = $request->except('_token', 'password');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $this->studentRepository->update($id, $data);

        return back()->with('msg', __('students::messages.update.success'));
    }

    public function delete($id)
    {
        /*
        Dữ liệu liên quan: 
        - Liên kết giữa học viên và khóa học
        - Trung gian: Thống kê học viên, liên kết tài khoản mạng xã hội
        */
        $this->studentRepository->delete($id);

        return back()->with('msg', __('students::messages.delete.success'));
    }
}