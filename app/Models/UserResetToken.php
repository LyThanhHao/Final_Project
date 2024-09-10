<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResetToken extends Model
{
    use HasFactory;

    // Đặt khóa chính là email
    protected $primaryKey = 'email';

    // Khóa chính không tự tăng
    public $incrementing = false;

    // Khóa chính là kiểu chuỗi
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'token',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
