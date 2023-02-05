<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CoursesRepositoryInterface extends RepositoryInterface
{
    public function getAllCourses();
}
