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

    public function getAllLessions()
    {
        return $this->getAll();
    }
}
