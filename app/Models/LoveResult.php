<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveResult extends Model
{
    protected $fillable = ['love_input_id', 'full_data'];

    public function input()
    {
        return $this->belongsTo(LoveInput::class);
    }
}
