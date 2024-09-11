<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'a',
        'b',
        'c',
        'd',
        'answer',
        
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
