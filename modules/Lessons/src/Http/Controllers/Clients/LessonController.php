<?php

namespace Modules\Lessons\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;

class LessonController extends Controller
{
    protected $lessonRepository;
    public function __construct(LessonsRepositoryInterface $lessonRepository)
    {

        $this->lessonRepository = $lessonRepository;
    }

    public function index($slug)
    {
        $lesson = $this->lessonRepository->getLesssonActive($slug);

        if (!$lesson) {
            abort(404);
        }

        $pageTitle = $lesson->name;
        $pageName = $lesson->name;
        $course = $lesson->course;
        $index = 0;

        return view('lessons::clients.index', compact('pageTitle', 'pageName', 'lesson', 'course', 'index'));
    }
}