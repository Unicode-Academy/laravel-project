<?php

namespace Modules\Courses\src\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;
use Modules\Lessons\src\Models\Lesson;
use Modules\Orders\src\Models\OrderDetail;
use Modules\Teacher\src\Models\Teacher;

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
        'status',
    ];

    protected $with = ['teacher'];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_courses');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'course_id', 'id')->withoutGlobalScopes();
    }
}
