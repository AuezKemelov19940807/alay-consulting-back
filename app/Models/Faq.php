<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'title_en',
        'items', // JSON поле
    ];

    protected $casts = [
        'items' => 'array', // автоматически преобразуем JSON в массив
    ];
}
