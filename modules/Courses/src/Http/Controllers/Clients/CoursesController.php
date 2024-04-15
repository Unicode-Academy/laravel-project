<?php
namespace Modules\Courses\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class CoursesController extends Controller
{
    protected $coursesRepository;
    public function __construct(
        CoursesRepositoryInterface $coursesRepository,
    ) {
        $this->coursesRepository = $coursesRepository;
    }
    public function index()
    {
        $pageTitle = 'Khóa học';
        $pageName = 'Khóa học';
        $courses = $this->coursesRepository->getCourses(config('paginate.limit'));

        return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses'));
    }

    public function detail($slug)
    {
        $course = $this->coursesRepository->getCourseActive($slug);
        if (!$course) {
            abort(404);
        }
        $pageTitle = $course->name;
        $pageName = $course->name;
        $index = 0;
        return view('courses::clients.detail', compact('pageTitle', 'pageName', 'course', 'index'));
    }
}
