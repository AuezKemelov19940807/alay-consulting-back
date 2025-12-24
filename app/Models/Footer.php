<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'text',
        'text_kk',
        'text_en',
        'menu',
        'socials',
    ];

    // Кастинг JSON-полей в массив
    protected $casts = [
        'menu' => 'array',      // Массив ссылок
        'socials' => 'array',   // Массив соцсетей
    ];
}
