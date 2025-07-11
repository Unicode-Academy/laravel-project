<?php

namespace Modules\Students\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';

    public function students()
    {
        return $this->belongsToMany(Student::class, 'coupons_students', 'coupon_id', 'student_id');
    }
}
