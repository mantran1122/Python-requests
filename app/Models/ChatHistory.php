<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    protected $fillable = ['love_input_id', 'question', 'reply'];

    public function input()
    {
        return $this->belongsTo(LoveInput::class);
    }
}
