<?php

namespace Modules\Categories\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CategoriesRepositoryInterface extends RepositoryInterface
{
    public function getCategories();
}