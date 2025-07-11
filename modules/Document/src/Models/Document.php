<?php

namespace Modules\Document\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url',
        'size'
    ];

    protected $attributes = [
        'size' => 0
    ];

    public function documents()
    {
        return $this->hasMany(
            Document::class,
            'document_id',
            'id'
        );
    }
}
