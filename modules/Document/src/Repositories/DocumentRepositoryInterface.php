<?php

namespace Modules\Document\src\Repositories;

use App\Repositories\RepositoryInterface;

interface DocumentRepositoryInterface extends RepositoryInterface
{
    public function createDocument($data, $url);
}
