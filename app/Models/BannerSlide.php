<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSlide extends Model
{
    protected $fillable = [
        'banner_id',
        'image',
        'alt',
        'sort_order',
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
