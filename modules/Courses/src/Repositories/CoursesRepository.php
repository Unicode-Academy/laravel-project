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
        return $this->model->select(['id', 'name', 'price', 'status', 'sale_price', 'created_at'])->latest();
    }

    public function createCourseCategories($course, $data = [])
    {
        return $course->categories()->attach($data);
    }

    public function updateCourseCategories($course, $data = [])
    {
        return $course->categories()->sync($data);
    }

    public function deleteCourseCategories($course)
    {
        return $course->categories()->detach();
    }

    public function getRelatedCategories($course)
    {
        $categoryIds = $course->categories()->allRelatedIds()->toArray();
        return $categoryIds;
    }
}
