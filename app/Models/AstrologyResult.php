<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstrologyResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'birth_info_id',
        'zodiac',
        'result_json',
        'type',
    ];

    /**
     * Mỗi kết quả chiêm tinh thuộc về một thông tin sinh
     */
    public function birthInfo()
    {
        return $this->belongsTo(BirthInfo::class);
    }
}
