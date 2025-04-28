<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlmConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'api_key',
        'model',
        'provider',
        'active',
    ];
}
