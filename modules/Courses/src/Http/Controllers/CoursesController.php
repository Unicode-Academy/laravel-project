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
        ->editColumn('status', function ($course) {
            return $course->status == 1 ? '<button class="btn btn-success">Ra mắt</button>' : '<button class="btn btn-warning">Chưa ra mắt</button>';
        })
        ->editColumn('price', function ($course) {
            if ($course->price) {
                if ($course->sale_price) {
                    $price = number_format($course->sale_price).'đ';
                } else {
                    $price = number_format($course->price).'đ';
                }
            } else {
                $price = 'Miễn phí';
            }

            return $price;
        })
        ->rawColumns(['edit', 'delete', 'status'])
        ->toJson();
        return $data;
    }

    public function create()
    {
        $pageTitle = 'Thêm khóa học';
        return view('courses::add', compact('pageTitle'));
    }

    public function store(CoursesRequest $request)
    {
        $courses = $request->except(['_token']);
        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }

        $this->coursesRepository->create($courses);

        return redirect()->route('admin.courses.index')->with('msg', __('courses::messages.create.success'));
    }

    public function edit($id)
    {
        $course = $this->coursesRepository->find($id);

        if (!$course) {
            abort(404);
        }

        $pageTitle = 'Cập nhật khóa học';

        return view('courses::edit', compact('course', 'pageTitle'));
    }

    public function update(CoursesRequest $request, $id)
    {
        $courses = $request->except(['_token', '_method']);
        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }

        $this->coursesRepository->update($id, $courses);

        return back()->with('msg', __('courses::messages.update.success'));
    }

    public function delete($id)
    {
        $this->coursesRepository->delete($id);
        return back()->with('msg', __('courses::messages.delete.success'));
    }
}