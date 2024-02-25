<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Lessons\src\Http\Requests\LessonRequest;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Video\src\Repositories\VideoRepositoryInterface;

class LessonController extends Controller
{
    protected $coursesRepository, $videoRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository, VideoRepositoryInterface $videoRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->videoRepository = $videoRepository;
    }

    public function index($courseId)
    {
        $course = $this->coursesRepository->find($courseId);

        $pageTitle = "Bài giảng: " . $course->name;

        return view('lessons::lists', compact('pageTitle', 'course'));
    }

    public function create($courseId)
    {
        $pageTitle = 'Thêm bài giảng';
        return view('lessons::add', compact('pageTitle', 'courseId'));
    }

    public function store(LessonRequest $request)
    {
        $video = $request->video;
        $result = $this->videoRepository->createVideo(['url' => $video]);
        dd($result);
    }
}
