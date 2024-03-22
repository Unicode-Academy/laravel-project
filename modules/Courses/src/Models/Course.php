<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Teacher\src\Models\Teacher;
use Modules\Categories\src\Models\Category;

class Course extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'detail',
        'teacher_id',
        'thumbnail',
        'price',
        'sale_price',
        'code',
        'durations',
        'is_document',
        'supports',
        'status'
    ];

    protected $with = ['teacher'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_courses');
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}