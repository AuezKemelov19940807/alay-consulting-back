<?php

namespace App\Services;

use App\Models\Seo;

class SeoService
{
    protected Seo $seo;

    public function __construct()
    {
        // Берём первую запись SEO или создаём дефолтную
        $this->seo = Seo::first() ?? $this->createDefault();
    }

    /**
     * Получить SEO данные
     */
    public function get(string $locale = 'ru'): object
    {
        return (object) [
            'title' => $this->seo->{'title_'.$locale} ?? '',
            'og_title' => $this->seo->{'og_title_'.$locale} ?? '',
            'description' => $this->seo->{'description_'.$locale} ?? '',
            'og_description' => $this->seo->{'og_description_'.$locale} ?? '',
            'og_image' => $this->seo->og_image ? asset('storage/' . $this->seo->og_image) : null,
            'twitter_card' => $this->seo->twitter_card ?? '',
        ];
    }

    /**
     * Создать дефолтный SEO
     */
    protected function createDefault(): Seo
    {
        return Seo::create([
            'title_ru' => 'Default Title RU',
            'title_kk' => 'Default Title KK',
            'title_en' => 'Default Title EN',

            'og_title_ru' => 'Default OG Title RU',
            'og_title_kk' => 'Default OG Title KK',
            'og_title_en' => 'Default OG Title EN',

            'description_ru' => 'Default Description RU',
            'description_kk' => 'Default Description KK',
            'description_en' => 'Default Description EN',

            'og_description_ru' => 'Default OG Description RU',
            'og_description_kk' => 'Default OG Description KK',
            'og_description_en' => 'Default OG Description EN',

            'og_image' => null,
            'twitter_card' => 'summary',
        ]);
    }
}
