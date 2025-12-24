<?php

namespace App\Services;

use App\Models\WhyChooseUs;

class WhyChooseUsService
{
    /**
     * Получить первую запись или создать дефолтную.
     */
    public function getFirst(string $locale = 'ru'): object
    {
        $record = WhyChooseUs::first();

        if (! $record) {
            $record = $this->createDefault();
        }

        return $this->format($record, $locale);
    }

    /**
     * Создание дефолтной записи.
     */
    protected function createDefault(): WhyChooseUs
    {
        return WhyChooseUs::create([
            'title' => 'Почему выбирают нас',
            'title_kk' => 'Неліктен бізді таңдайды',
            'title_en' => 'Why choose us',
            'image' => null,
            'items' => [
                [
                    'icon' => 'work',
                    'text' => 'Работаем по всему Казахстану',
                    'text_kk' => 'Қазақстан бойынша жұмыс істейміз',
                    'text_en' => 'We work all over Kazakhstan',
                ],
                [
                    'icon' => 'reminder',
                    'text' => 'Напоминания о сроках налогов',
                    'text_kk' => 'Салық мерзімдері туралы еске салу',
                    'text_en' => 'Tax deadline reminders',
                ],
                [
                    'icon' => 'transparent',
                    'text' => 'Прозрачные тарифы',
                    'text_kk' => 'Айқын тарифтер',
                    'text_en' => 'Transparent rates',
                ],
                [
                    'icon' => 'digital',
                    'text' => 'Полная цифровизация — всё онлайн',
                    'text_kk' => 'Толық цифрландыру — бәрі онлайн',
                    'text_en' => 'Full digitalization — all online',
                ],
                [
                    'icon' => 'whatsapp',
                    'text' => 'Поддержка в WhatsApp 7/7',
                    'text_kk' => 'WhatsApp 7/7 қолдау',
                    'text_en' => 'WhatsApp support 7/7',
                ],
                [
                    'icon' => 'privacy',
                    'text' => 'Конфиденциальность данных',
                    'text_kk' => 'Деректер құпиялығы',
                    'text_en' => 'Data privacy',
                ],
            ],
        ]);
    }

    /**
     * Форматирование данных под API с учётом языка.
     */
    protected function format(WhyChooseUs $record, string $locale): object
    {
        return (object) [
            'title' => $this->resolveTitle($record, $locale),

            'image' => $record->image
                ? asset('storage/' . $record->image)
                : null,

            'items' => collect($record->items)->map(fn ($item) => [
                'icon' => !empty($item['icon'])
                    ? asset('storage/' . $item['icon'])
                    : null,
                'text' => $item['text_'.$locale] ?? $item['text'] ?? '',
            ])->values(),
        ];
    }

    /**
     * Универсально получаем title (строка или JSON)
     */
    protected function resolveTitle(WhyChooseUs $record, string $locale): string
    {
        // Если есть title_ru / title_kk / title_en — берём их
        if (!empty($record->{'title_'.$locale})) {
            return $record->{'title_'.$locale};
        }

        // Если title — JSON-строка
        if (is_string($record->title)) {
            $decoded = json_decode($record->title, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded[$locale] ?? $decoded['ru'] ?? '';
            }
        }

        // Обычная строка
        return (string) $record->title;
    }
}
