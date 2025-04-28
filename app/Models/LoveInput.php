<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveInput extends Model
{
    protected $fillable = [
        'person_a_name',
        'person_a_birthplace',
        'person_a_birthdate',
        'person_a_birthtime',
        'person_b_name',
        'person_b_birthplace',
        'person_b_birthdate',
        'person_b_birthtime',
    ];

    public function result()
    {
        return $this->hasOne(LoveResult::class);
    }

    public function chats()
    {
        return $this->hasMany(ChatHistory::class);
    }
}
