<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    protected $table = 'client_reviews';

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
