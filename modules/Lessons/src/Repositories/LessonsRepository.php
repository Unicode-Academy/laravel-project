<?php

namespace Modules\Lessons\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Lessons\src\Models\Lesson;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;

class LessonsRepository extends BaseRepository implements LessonsRepositoryInterface
{
    public function getModel()
    {
        return Lesson::class;
    }

    public function getPosition($courseId)
    {
        $result = $this->model->where('course_id', $courseId)->count();
        return $result + 1;
    }

    public function getLessons($courseId)
    {
        return $this->model->with('subLessons')->whereCourseId($courseId)->whereNull('parent_id')->select(['id', 'name', 'slug', 'is_trial', 'parent_id', 'view', 'durations', 'course_id'])->orderBy('position', 'asc');
    }

    public function getAllLessions($courseId)
    {
        return $this->model->where('course_id', $courseId)->get();
    }

    public function getLessonCount($course)
    {
        return (object) [
            'module' => $course->lessons()->whereNull('parent_id')->count(),
            'lessons' => $course->lessons()->whereNotNull('parent_id')->count(),
        ];
    }

    public function getModuleByPosition($course)
    {
        return $course->lessons()->whereNull('parent_id')->orderBy('position')->get();
    }

    public function getLessonsByPosition($course, $moduleId)
    {
        return $course->lessons()->where('parent_id', $moduleId)->orderBy('position')->get();
    }

    public function getLesssonActive($slug) {
        return $this->model->whereSlug($slug)->first();
    }

}