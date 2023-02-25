<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;

class CourseCategory extends Model
{
    protected $fillable = [
        'category_id',
        'course_id',
    ];

    public function categories()
    {
        $this->belongsToMany(Category::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
