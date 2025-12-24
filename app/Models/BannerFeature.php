<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerFeature extends Model
    {
    protected $fillable = [
        'banner_id',
        'icon',
        'text',
        'text_kk',
        'text_en',
        'sort_order',
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
