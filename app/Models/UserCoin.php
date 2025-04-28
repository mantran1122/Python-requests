<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCoin extends Model
{
    protected $fillable = ['user_id', 'coins_change', 'reason'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Tổng coins hiện tại
    public static function balance($userId) {
        return static::where('user_id', $userId)->sum('coins_change');
    }

    // Trừ 1 coin khi thao tác (nếu còn)
    public static function deductOne($userId, $reason = 'Thao tác') {
        if (static::balance($userId) <= 0) return false;
        return static::create([
            'user_id' => $userId,
            'coins_change' => -1,
            'reason' => $reason,
        ]);
    }
}