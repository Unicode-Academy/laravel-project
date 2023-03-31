<?php

namespace Modules\Categories\src\Models;

use Modules\Courses\src\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->children()->with('subCategories');
    }

    public function courses()
    {
        $this->belongsToMany(Course::class, 'categories_courses');
    }
}