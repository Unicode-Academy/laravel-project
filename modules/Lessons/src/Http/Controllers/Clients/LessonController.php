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

        $lessons = $this->lessonRepository->getLessonsByPosition($course);
        $currentLessonIndex = null;
        foreach ($lessons as $key => $item) {
            if ($item->id == $lesson->id) {
                $currentLessonIndex = $key;
                break;
            }
        }
        $nextLesson = null;
        $prevLesson = null;
        if (isset($lessons[$currentLessonIndex + 1])) {
            $nextLesson = $lessons[$currentLessonIndex + 1];
        }

        if (isset($lessons[$currentLessonIndex - 1])) {
            $prevLesson = $lessons[$currentLessonIndex - 1];
        }

        return view('lessons::clients.index', compact('pageTitle', 'pageName', 'lesson', 'course', 'index', 'nextLesson', 'prevLesson'));
    }
}