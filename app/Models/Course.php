<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name', 'category_id', 'user_id', 'image', 'file'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'cat_id');
    }
}
