<?php

namespace Modules\Lessons\src\Models;

use Modules\Video\src\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Modules\Document\src\Models\Document;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    protected $table = 'lessons';
    protected $fillable = [
        'name',
        'slug',
        'video_id',
        'course_id',
        'document_id',
        'parent_id',
        'is_trial',
        'view',
        'position',
        'durations',
        'description',
    ];
    protected $with = ['video'];

    public function children()
    {
        return $this->hasMany(Lesson::class, 'parent_id');
    }

    public function subLessons()
    {
        return $this->children()->with('subLessons');
    }

    public function video() {
        return $this->belongsTo(
            Video::class,
            'video_id',
            'id'
        );
    }

    public function document() {
        return $this->belongsTo(
            Document::class,
            'document_id',
            'id'
        );
    }
}
