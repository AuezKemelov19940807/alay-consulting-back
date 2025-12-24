<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $table = 'main';
    protected $fillable = [
        'banner_id',
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    // позже можно добавить методы для других секций
    // public function hero() { ... }
    // public function services() { ... }
}
