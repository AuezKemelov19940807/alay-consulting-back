<?php

namespace App\Services;

use App\Models\WhyChooseUs;

class WhyChooseUsService
{
    public function get(string $locale = 'ru'): object
    {
        $record = WhyChooseUs::first();

        if (!$record) {
            $record = $this->createDefault();
        }

        $items = $record->items ?? [];

        return (object)[
            'title' => $this->resolveTitle($record, $locale),
            'image' => $record->image ? asset('storage/' . $record->image) : null,
            'items' => collect($items)->map(function ($item) use ($locale) {
                return (object)[
                    'icon' => isset($item['icon']) ? asset('storage/' . $item['icon']) : null,
                    'text' => $item['text_'.$locale] ?? $item['text'] ?? '',
                ];
            })->values(),
        ];
    }

    public function getFirst(string $locale = 'ru'): object
    {
        return $this->get($locale);
    }

    protected function resolveTitle(WhyChooseUs $record, string $locale): string
    {
        // Сначала берём отдельное поле title_{locale}
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

        // fallback
        return (string) $record->title;
    }

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

    public function update(array $data): WhyChooseUs
    {
        $record = WhyChooseUs::first() ?? WhyChooseUs::create([]);

        $record->update([
            'title' => $data['title'] ?? $record->title,
            'title_kk' => $data['title_kk'] ?? $record->title_kk,
            'title_en' => $data['title_en'] ?? $record->title_en,
            'image' => $data['image'] ?? $record->image,
            'items' => $data['items'] ?? $record->items,
        ]);

        return $record;
    }
}
