<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\BannerFeature;
use App\Models\BannerSlide;

class BannerService
{
    /**
     * Вернуть первый баннер или создать дефолтный в базе
     */
    public function getFirst(string $locale = 'ru'): object
    {
        $banner = Banner::with(['features', 'sliders'])->first();

        if (!$banner) {
            $banner = $this->createDefaultBanner();
            $banner->load(['features', 'sliders']);
        }

        return $this->formatBanner($banner, $locale);
    }

    /**
     * Создаём дефолтный баннер в базе
     */
    protected function createDefaultBanner(): Banner
    {
        $banner = Banner::create([
            'title' => 'Добро пожаловать',
            'title_kk' => 'Қош келдіңіз',
            'title_en' => 'Welcome',
            'description' => 'Мы помогаем решать задачи быстро и эффективно',
            'description_kk' => 'Біз тапсырмаларды жылдам және тиімді шешуге көмектесеміз',
            'description_en' => 'We help solve tasks quickly and efficiently',
            'button_text' => 'Подробнее',
            'button_text_kk' => 'Толығырақ',
            'button_text_en' => 'Learn more',
            'is_active' => true,
        ]);

        // Дефолтные фичи
        $features = [
            [
                'icon' => 'check',
                'text' => 'Опытная команда',
                'text_kk' => 'Тәжірибелі команда',
                'text_en' => 'Experienced team',
            ],
            [
                'icon' => 'shield',
                'text' => 'Надёжность и качество',
                'text_kk' => 'Сенімділік және сапа',
                'text_en' => 'Reliability and quality',
            ],
        ];

        foreach ($features as $f) {
            $banner->features()->create($f);
        }

        // Дефолтный слайд
        $banner->sliders()->create([
            'image' => '/images/banner/default-1.jpg',
            'alt' => 'Banner',
            'alt_kk' => 'Баннер',
            'alt_en' => 'Banner',
        ]);

        return $banner;
    }

    /**
     * Преобразуем модель Banner в объект для API с учётом языка
     */
    protected function formatBanner(Banner $banner, string $locale): object
    {
        return (object) [
            'title' => $banner->{'title_'.$locale} ?? $banner->title,
            'description' => $banner->{'description_'.$locale} ?? $banner->description,
            'button_text' => $banner->{'button_text_'.$locale} ?? $banner->button_text,
            'features' => $banner->features->map(fn($f) => (object)[
                'icon' => $f->icon
                    ? asset('storage/' . $f->icon)
                    : null,
                'text' => $f->{'text_'.$locale} ?? $f->text,
            ]),
            'sliders' => $banner->sliders->map(fn($s) => (object)[
                'image' => $s->image
                    ? asset('storage/' . $s->image)
                    : null,
                'alt' => $s->{'alt_'.$locale} ?? $s->alt,
            ]),
        ];
    }
}
