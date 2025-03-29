<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'birth_date',
        'birth_time',
        'gender',
        'birth_place'
    ];

    /**
     * Một bản ghi BirthInfo có thể có nhiều kết quả chiêm tinh
     */
    public function astrologyResults()
    {
        return $this->hasMany(AstrologyResult::class);
    }

    /**
     * Nếu có liên kết người dùng, mỗi BirthInfo thuộc về một User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
