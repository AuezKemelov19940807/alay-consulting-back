<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = 'why_choose_us';

    protected $fillable = [
        'title',
        'title_kk',
        'title_en',
        'image',
        'items', // JSON
    ];

    protected $casts = [
        'items' => 'array', // Автоматическое преобразование JSON в массив
    ];
}
