<?php
namespace Modules\Courses\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class CoursesController extends Controller {
    protected $coursesRepository;
    public function __construct(
        CoursesRepositoryInterface $coursesRepository,
    ) {
        $this->coursesRepository = $coursesRepository;
    }
    public function index() {
        $pageTitle = 'Khóa học';
        $pageName = 'Khóa học';
        $courses = $this->coursesRepository->getCourses(9);
        
        return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses'));
    }
}