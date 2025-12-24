<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title', 'description', 'button_text',
        'title_kk', 'description_kk', 'button_text_kk',
        'title_en', 'description_en', 'button_text_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function features()
    {
        return $this->hasMany(BannerFeature::class)->orderBy('sort_order');
    }

    public function sliders()
    {
        return $this->hasMany(BannerSlide::class)->orderBy('sort_order');
    }
}
