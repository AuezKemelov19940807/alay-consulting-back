<?php

namespace App\Services;

use App\Models\Faq;

class FaqService
{
    protected Faq $faq;

    public function __construct()
    {
        // Берём первую запись или создаём дефолтную
        $this->faq = Faq::first() ?? $this->createDefault();
    }

    /**
     * Получить FAQ
     */
    public function get(string $locale = 'ru'): object
    {
        return $this->format($this->faq, $locale);
    }

    /**
     * Форматируем данные под язык
     */
    protected function format(Faq $faq, string $locale): object
    {
        return (object) [
            'title' => $faq->{'title_'.$locale} ?? $faq->title,
            'items' => collect($faq->items ?? [])->map(function ($item) use ($locale) {
                return (object) [
                    'question' => $item['question'][$locale]
                        ?? $item['question']['ru']
                            ?? '',
                    'answer' => $item['answer'][$locale]
                        ?? $item['answer']['ru']
                            ?? '',
                ];
            })->toArray(),
        ];
    }

    /**
     * Создаём дефолтный FAQ
     */
    protected function createDefault(): Faq
    {
        return Faq::create([
            'title' => 'Часто задаваемые вопросы',
            'title_kk' => 'Жиі қойылатын сұрақтар',
            'title_en' => 'Frequently Asked Questions',

            'items' => [
                [
                    'question' => [
                        'ru' => 'Как долго длится консультация?',
                        'kk' => 'Консультация қанша уақытқа созылады?',
                        'en' => 'How long does the consultation take?',
                    ],
                    'answer' => [
                        'ru' => 'От нескольких дней до недели.',
                        'kk' => 'Бірнеше күннен бір аптаға дейін.',
                        'en' => 'From a few days up to a week.',
                    ],
                ],
                [
                    'question' => [
                        'ru' => 'Можно ли получить консультацию онлайн?',
                        'kk' => 'Онлайн кеңес алуға бола ма?',
                        'en' => 'Is online consultation available?',
                    ],
                    'answer' => [
                        'ru' => 'Да, консультация возможна онлайн.',
                        'kk' => 'Иә, онлайн кеңес алуға болады.',
                        'en' => 'Yes, online consultation is available.',
                    ],
                ],
            ],
        ]);
    }
}
