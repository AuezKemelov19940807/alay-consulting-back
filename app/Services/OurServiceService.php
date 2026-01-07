<?php

namespace App\Services;

use App\Models\OurService;

class OurServiceService
{
    /**
     * Получить блок our_services для конкретного языка
     */
    public function get(string $locale = 'ru'): object
    {
        $service = OurService::first();

        if (!$service) {
            $service = OurService::create([
                'data' => [
                    'title' => [
                        'ru' => 'Наши услуги',
                        'kk' => 'Біздің қызметтер',
                        'en' => 'Our Services',
                    ],
                    'items' => [],
                ],
            ]);
        }

        $data = $service->data;

        return (object)[
            'title' => $service->{'title_'.$locale} ?? $service->title,


            'items' => collect($data['items'] ?? [])->map(function ($item) use ($locale) {
                return (object)[
                    'title' => $item['title'][$locale]
                        ?? ($item['title']['ru'] ?? ''),


                    'icon' => isset($item['icon']) ? asset('storage/' . $item['icon']) : null,

                    'subtitle' => isset($item['subtitle']) ? (object)[



                        'icon' => isset($item['subtitle']['icon']) ? asset('storage/' . $item['subtitle']['icon']) : null,

                        'items' => collect($item['subtitle']['items'] ?? [])
                            ->map(function ($sub) use ($locale) {
                                return (object)[
                                    'title' => $sub['title'][$locale]
                                        ?? ($sub['title']['ru'] ?? ''),
                                ];
                            })
                            ->values(),
                    ] : null,
                ];
            })->values(),
        ];
    }

    /**
     * Обновить блок our_services
     */
    public function update(array $data): OurService
    {
        $service = OurService::first() ?? OurService::create(['data' => []]);

        $service->update([
            'data' => $data,
        ]);

        return $service;
    }
}
