<?php

namespace Modules\Students\src\Models;

use App\Notifications\EmailVerifyQueued;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

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
        'phone',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerifyQueued);
    }

}