<?php

namespace Modules\Video\src\Models;

use Modules\Courses\src\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
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

    public function courses() {
        return $this->hasMany(
            Lesson::class,
            'video_id',
            'id'
        );
    }
}
