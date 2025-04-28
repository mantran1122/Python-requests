<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ Quan hệ với bảng user_coins
    public function coins()
    {
        return $this->hasMany(UserCoin::class);
    }

    // ✅ Lấy tổng coin hiện tại
    public function coinBalance(): int
    {
        return $this->coins()->sum('coins_change');
    }

}
