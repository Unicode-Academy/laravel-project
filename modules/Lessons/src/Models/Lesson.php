<?php

namespace Modules\Lessons\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;
use Modules\Document\src\Models\Document;
use Modules\Video\src\Models\Video;

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
    protected $with = ['video', 'document'];

    public function children()
    {
        return $this->hasMany(Lesson::class, 'parent_id');
    }

    public function subLessons()
    {
        return $this->children()->orderBy('position', 'asc')->with('subLessons');
    }

    public function video()
    {
        return $this->belongsTo(
            Video::class,
            'video_id',
            'id'
        );
    }

    public function document()
    {
        return $this->belongsTo(
            Document::class,
            'document_id',
            'id'
        );
    }

    public function course()
    {
        return $this->belongsTo(
            Course::class,
            'course_id',
            'id'
        );
    }
}