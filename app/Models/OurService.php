<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'title_en',

        'data'];

    protected $casts = [
        'data' => 'array', // автоматически конвертирует JSON в массив
    ];
}
