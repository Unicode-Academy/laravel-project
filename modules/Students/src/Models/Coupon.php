<?php

namespace Modules\Students\src\Models;

use Modules\Orders\src\Models\Order;
use Modules\Courses\src\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';

    public function students()
    {
        return $this->belongsToMany(Student::class, 'coupons_students', 'coupon_id', 'student_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'coupons_courses', 'coupon_id', 'course_id')->withoutGlobalScopes();
    }

    public function usages()
    {
        return $this->belongsToMany(Order::class, 'coupons_usage', 'coupon_id', 'order_id');
    }
}
