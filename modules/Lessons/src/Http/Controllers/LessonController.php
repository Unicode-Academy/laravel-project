<?php

namespace Modules\Lessons\src\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Modules\Lessons\src\Http\Requests\LessonRequest;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;

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

    public function data($courseId)
    {
        $lessons = $this->lessonRepository->getLessons($courseId);

        $lessons = DataTables::of($lessons)->toArray();

        $lessons['data'] = $this->getLessionsTable($lessons['data']);
        return $lessons;
    }

    public function getLessionsTable($lessons, $char = '', &$result = [])
    {
        if (!empty($lessons)) {
            foreach ($lessons as $key => $lesson) {
                $row = $lesson;
                $row['name'] = $char . $row['name'];
                if ($row['parent_id'] == null) {
                    $row['is_trial'] = '';
                    $row['view'] = '';
                    $row['durations'] = '';
                    $row['created_at'] = '';
                    $row['edit'] = '<a href="" class="btn btn-warning">Sửa</a>';
                    $row['delete'] = '<a href="" class="btn btn-danger delete-action">Xóa</a>';
                } else {
                    $row['is_trial'] = ($row['is_trial'] == 1 ? 'Có' : 'Không');
                    $row['view'] = $row['view'];
                    $row['durations'] = $row['durations'] . ' giây';
                    $row['edit'] = '<a href="" class="btn btn-warning">Sửa</a>';
                    $row['delete'] = '<a href="" class="btn btn-danger delete-action">Xóa</a>';
                    $row['created_at'] = Carbon::parse($lesson['created_at'])->format('d/m/Y H:i:s');
                }

                unset($row['sub_lessons']);
                unset($row['updated_at']);
                $result[] = $row;
                if (!empty($lesson['sub_lessons'])) {
                    $this->getLessionsTable($lesson['sub_lessons'], $char . '|--', $result);
                }
            }
        }

        return $result;
    }

    public function create(Request $request, $courseId)
    {
        $pageTitle = 'Thêm bài giảng';
        $position = $this->lessonRepository->getPosition($courseId);
        $lessons = $this->lessonRepository->getAllLessions();
        return view('lessons::add', compact('pageTitle', 'courseId', 'position', 'lessons'));
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
        if ($video) {
            $videoInfo = getVideoInfo($video);
            $video = $this->videoRepository->createVideo(['url' => $video, 'name' => $videoInfo['filename'], 'size' => $videoInfo['playtime_seconds']], $video);
            $videoId = $video ? $video->id : null;
        }

        $this->lessonRepository->create([
            'name' => $name,
            'slug' => $slug,
            'video_id' => $videoId,
            'course_id' => $courseId,
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
