<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatChartHistory extends Model
{
    protected $fillable = [
        'user_id',
        'user_message',
        'ai_response',
        'astro_data',
        'chart_type'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
