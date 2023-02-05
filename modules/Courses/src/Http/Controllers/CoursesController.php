<?php

namespace Modules\Courses\src\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepository;

class CoursesController extends Controller
{
    protected $coursesRepository;

    public function __construct(CoursesRepository $coursesRepository)
    {
        $this->coursesRepository = $coursesRepository;
    }
    public function index()
    {
        $pageTitle = 'Quản lý khóa học';

        return view('courses::lists', compact('pageTitle'));
    }

    public function data()
    {
        $courses = $this->coursesRepository->getAllCourses();

        $data =  DataTables::of($courses)
        ->addColumn('edit', function ($course) {
            return '<a href="'.route('admin.courses.edit', $course).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function ($course) {
            return '<a href="'.route('admin.courses.delete', $course).'" class="btn btn-danger delete-action">Xóa</a>';
        })
        ->editColumn('created_at', function ($course) {
            return Carbon::parse($course->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
        return $data;
    }

    public function create()
    {
        $pageTitle = 'Thêm khóa học';
        return view('courses::add', compact('pageTitle'));
    }

    public function store(UserRequest $request)
    {
    }

    public function edit($id)
    {
        $course = $this->coursesRepository->find($id);

        if (!$user) {
            abort(404);
        }

        $pageTitle = 'Cập nhật khóa học';

        return view('courses::edit', compact('course', 'pageTitle'));
    }

    public function update(UserRequest $request, $id)
    {
    }

    public function delete($id)
    {
        $this->coursesRepository->delete($id);
        return back()->with('msg', __('courses::messages.delete.success'));
    }
}
