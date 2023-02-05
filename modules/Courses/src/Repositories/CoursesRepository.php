<?php

namespace Modules\Courses\src\Repositories;


use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Course;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }


    public function getAllCourses()
    {
        return $this->model->select(['id', 'name', 'price', 'status', 'created_at']);
    }
}