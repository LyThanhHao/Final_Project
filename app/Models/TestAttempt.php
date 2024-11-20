<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_id',
        'status',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'test_attempt_id');
    }
}
