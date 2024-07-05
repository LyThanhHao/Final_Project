<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name', 'cat_id', 'user_id', 'image', 'file'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
