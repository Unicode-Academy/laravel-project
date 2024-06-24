<?php

namespace Modules\Students\src\Models;

use App\Notifications\EmailVerifyQueued;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordQueued;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Courses\src\Models\Course;

class Student extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'address',
        'phone'
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerifyQueued);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordQueued($token));
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'students_courses')->withPivot('status');
    }
}
