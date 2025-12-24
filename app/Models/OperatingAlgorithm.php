<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatingAlgorithm extends Model
{
    protected $fillable = [
        'image',
        'title',
        'title_kk',
        'title_en',
        'description',
        'description_kk',
        'description_en',
        'image',
        'steps',
    ];

    protected $casts = [
        'steps' => 'array',
    ];
}
