<?php

namespace App\Services;

use App\Models\ClientReview;

class ClientReviewService
{
    protected ClientReview $review;

    public function __construct()
    {
        // Берём первую запись или создаём дефолтную
        $this->review = ClientReview::first() ?? $this->createDefault();
    }

    /**
     * Получить все отзывы
     */
    public function getAll(string $locale = 'ru'): array
    {
        $reviews = ClientReview::all();

        return $reviews->map(fn($r) => $this->format($r, $locale))->toArray();
    }

    /**
     * Получить первый отзыв
     */
    public function getFirst(string $locale = 'ru'): object
    {
        $review = ClientReview::first() ?? $this->createDefault();

        return $this->format($review, $locale);
    }

    /**
     * Форматируем данные по языку
     */
    protected function format(ClientReview $review, string $locale): object
    {
        return (object) [
            'title' => $review->{'title_'.$locale} ?? $review->title,
            'items' => collect($review->items ?? [])->map(function ($item) use ($locale) {
                return (object) [
                    'fullname' => $item['fullname_'.$locale] ?? $item['fullname'] ?? '',
                    'text' => $item['text_'.$locale] ?? $item['text'] ?? '',
                ];
            })->toArray(),
        ];
    }

    /**
     * Создаём дефолтные данные
     */
    protected function createDefault(): ClientReview
    {
        return ClientReview::create([
            'title' => 'Отзывы наших клиентов',
            'title_kk' => 'Біздің клиенттердің пікірлері',
            'title_en' => 'Our clients reviews',
            'items' => [
                [
                    'fullname' => [
                        'ru' => 'Дмитрий Кузнецов',
                        'kk' => 'Дмитрий Кузнецов',
                        'en' => 'Dmitry Kuznetsov',
                    ],
                    'text' => [
                        'ru' => 'Профессиональный подход и понятные рекомендации. Чувствуется опыт и ответственность.',
                        'kk' => 'Кәсіби тәсіл және түсінікті ұсыныстар. Тәжірибе мен жауапкершілік байқалады.',
                        'en' => 'Professional approach and clear recommendations. Experience and responsibility are felt.',
                    ],
                ],
                [
                    'fullname' => [
                        'ru' => 'Иван Иванов',
                        'kk' => 'Иван Иванов',
                        'en' => 'Ivan Ivanov',
                    ],
                    'text' => [
                        'ru' => 'Отличная компания! Всё объяснили простым языком, помогли разобраться с документами и сэкономить время.',
                        'kk' => 'Тамаша компания! Барлығын түсінікті тілде түсіндірді, құжаттарды реттеуге көмектесті және уақытты үнемдеді.',
                        'en' => 'Great company! Explained everything in simple language, helped with documents and saved time.',
                    ],
                ],
                [
                    'fullname' => [
                        'ru' => 'Алексей Петров',
                        'kk' => 'Алексей Петров',
                        'en' => 'Alexey Petrov',
                    ],
                    'text' => [
                        'ru' => 'Обращался впервые — остался доволен. Работают оперативно, без лишней бюрократии.',
                        'kk' => 'Бірінші рет жүгіндім — риза болдым. Жылдам жұмыс істейді, артық бюрократиясыз.',
                        'en' => 'First time using — satisfied. They work efficiently without unnecessary bureaucracy.',
                    ],
                ],
            ],
        ]);
    }
}
