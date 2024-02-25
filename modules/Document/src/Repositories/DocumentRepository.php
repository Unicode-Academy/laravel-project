<?php

namespace Modules\Document\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Document\src\Models\Document;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;

class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface
{
    public function getModel()
    {
        return Document::class;
    }

    public function createDocument($data)
    {
        return $this->model->firstOrCreate($data);
    }
}
