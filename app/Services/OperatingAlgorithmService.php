<?php

namespace App\Services;

use App\Models\OperatingAlgorithm;
use Illuminate\Support\Facades\Storage;

class OperatingAlgorithmService
{
    protected OperatingAlgorithm $algorithm;

    public function __construct()
    {
        // Берём первую запись из базы
        $this->algorithm = OperatingAlgorithm::firstOrFail();
    }

    /**
     * Получить алгоритм работы по языку
     */
    public function get(string $locale = 'ru'): object
    {
        return (object) [
            'title' => $this->algorithm->{'title_'.$locale} ?? $this->algorithm->title,
            'description' => $this->algorithm->{'description_'.$locale} ?? $this->algorithm->description,
            'image' => $this->algorithm->image ? asset('storage/' . $this->algorithm->image) : null,
            'steps' => collect($this->algorithm->steps ?? [])->map(function ($step) use ($locale) {
                return (object) [
                    'order' => $step['order'] ?? null,
                    'title' => $step['title_'.$locale] ?? $step['title'] ?? '',
                ];
            }),
        ];
    }
}
