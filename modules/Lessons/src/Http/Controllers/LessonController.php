<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Lessons\src\Http\Requests\LessonRequest;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;

class LessonController extends Controller
{
    protected $coursesRepository, $videoRepository, $documentRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository, VideoRepositoryInterface $videoRepository, DocumentRepositoryInterface $documentRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->videoRepository = $videoRepository;
        $this->documentRepository = $documentRepository;
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
        $document = $request->document;
        //$videoInfo = getVideoInfo($video);
        $documentInfo = getFileInfo($document);

        /*
        $result = $this->videoRepository->createVideo(['url' => $video, 'name' => $videoInfo['filename'], 'size' => $videoInfo['playtime_seconds']], $video);
        */
        $result = $this->documentRepository->createDocument([
            'name' => $documentInfo['name'],
            'url' => $document,
            'size' => $documentInfo['size']
        ], $document);

        /*
        $path = Storage::disk('public')->path(str_replace('storage', '', $request->document));
        $name = basename($request->document);

        $size = File::size($path);

        $result = $this->documentRepository->createDocument(['name' => $name, 'url' => $request->document]);
        */
        dd($result);
    }
}
