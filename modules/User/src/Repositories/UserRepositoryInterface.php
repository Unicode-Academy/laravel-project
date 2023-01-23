<?php

namespace Modules\User\src\Repositories;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    //Lấy danh sách người dùng
    public function getUsers();
}