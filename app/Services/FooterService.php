<?php

namespace App\Services;

use App\Models\Footer;

class FooterService
{
    protected Footer $footer;

    public function __construct()
    {
        // Берём первую запись футера или создаём дефолтную
        $this->footer = Footer::first() ?? $this->createDefault();
    }

    /**
     * Получить футер
     */
    public function get(string $locale = 'ru'): object
    {
        return (object) [
            'text' => $this->footer->{'text_'.$locale} ?? $this->footer->text ?? '',
            'menu' => collect($this->footer->menu ?? [])->map(function ($item) use ($locale) {
                return [
                    'label' => $item['label'][$locale] ?? $item['label']['ru'] ?? '',
                    'url' => $item['url'] ?? '#',
                ];
            })->toArray(),

            'socials' => collect($this->footer->socials ?? [])->map(function ($item) {
                return [
                    'icon' => !empty($item['icon'])
                        ? asset('storage/' . $item['icon'])
                        : null,
                    'url' => $item['url'] ?? '#',
                ];
            })->toArray(),
        ];
    }

    /**
     * Создать дефолтный футер
     */
    protected function createDefault(): Footer
    {
        return Footer::create([
            'text' => '© 2025 ALAU Consulting',
            'text_kk' => '© 2025 ALAU Consulting',
            'text_en' => '© 2025 ALAU Consulting',

            'menu' => [
                [
                    'label' => ['ru' => 'Главная', 'kk' => 'Басты бет', 'en' => 'Home'],
                    'url' => '/',
                ],
                [
                    'label' => ['ru' => 'Наши услуги', 'kk' => 'Қызметтер', 'en' => 'Our Services'],
                    'url' => '/services',
                ],
                [
                    'label' => ['ru' => 'Почему выбирают нас', 'kk' => 'Неге бізді таңдайды', 'en' => 'Why choose us'],
                    'url' => '/why-us',
                ],
            ],

            'socials' => [
                ['icon' => 'Whatsapp', 'url' => 'https://wa.me/...'],
                ['icon' => 'Facebook', 'url' => 'https://facebook.com/...'],
                ['icon' => 'Instagram', 'url' => 'https://instagram.com/...'],
                ['icon' => 'Telegram', 'url' => 'https://t.me/...'],
            ],
        ]);
    }
}
