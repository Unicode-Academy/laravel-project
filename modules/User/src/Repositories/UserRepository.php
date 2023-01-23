<?php

namespace Modules\User\src\Repositories;

use Modules\User\src\Models\User;
use App\Repositories\BaseRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUsers($limit=10)
    {
        return $this->model->limit($limit)->get();
    }
}