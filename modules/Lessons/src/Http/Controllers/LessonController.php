<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class LessonController extends Controller
{
    protected $coursesRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository, )
    {
        $this->coursesRepository = $coursesRepository;
    }

    public function index($courseId)
    {
        $course = $this->coursesRepository->find($courseId);

        $pageTitle = "Bài giảng: " . $course->name;

        return view('lessons::lists', compact('pageTitle', 'course'));
    }
}
