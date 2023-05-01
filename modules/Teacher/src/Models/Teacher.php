<?php

namespace Modules\Teacher\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';

    protected $fillable = [
        'name',
        'slug',
        'exp',
        'image',
        'description'
    ];
}