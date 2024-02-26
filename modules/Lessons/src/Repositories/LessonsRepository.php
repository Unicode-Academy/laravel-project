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
}
