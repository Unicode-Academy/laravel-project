<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Lessons\src\Http\Requests\LessonRequest;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;

class LessonController extends Controller
{
    protected $coursesRepository, $videoRepository, $documentRepository, $lessonRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository, VideoRepositoryInterface $videoRepository, DocumentRepositoryInterface $documentRepository, LessonsRepositoryInterface $lessonRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->videoRepository = $videoRepository;
        $this->documentRepository = $documentRepository;
        $this->lessonRepository = $lessonRepository;
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

    public function store($courseId, LessonRequest $request)
    {

        $name = $request->name;
        $slug = $request->slug;
        $video = $request->video;
        $document = $request->document;
        $parentId = $request->parent_id == 0 ? null : $request->parent_id;
        $isTrail = $request->is_trial;
        $position = $request->position;
        $description = $request->description;
        $videoInfo = getVideoInfo($video);
        $documentId = null;
        $videoId = null;
        if ($document) {
            $documentInfo = getFileInfo($document);
            $document = $this->documentRepository->createDocument([
                'name' => $documentInfo['name'],
                'url' => $document,
                'size' => $documentInfo['size']
            ], $document);
            $documentId = $document ? $document->id : null;
        }

        $video = $this->videoRepository->createVideo(['url' => $video, 'name' => $videoInfo['filename'], 'size' => $videoInfo['playtime_seconds']], $video);
        $videoId = $video ? $video->id : null;
        $this->lessonRepository->create([
            'name' => $name,
            'slug' => $slug,
            'video_id' => $videoId,
            'document_id' => $documentId,
            'parent_id' => $parentId,
            'is_trial' => $isTrail,
            'position' => $position,
            'durations' => $videoInfo['playtime_seconds'] ?? 0,
            'description' => $description,
        ]);
        return redirect()->route('admin.lessons.create', $courseId)->with('msg', __('lessons::messages.create.success'));
    }
}
