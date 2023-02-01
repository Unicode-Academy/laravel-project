<?php

namespace Modules\Categories\src\Models;

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
}