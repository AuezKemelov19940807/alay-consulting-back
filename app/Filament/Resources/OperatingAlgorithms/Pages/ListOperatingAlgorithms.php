<?php

namespace App\Filament\Resources\OperatingAlgorithms\Pages;

use App\Filament\Resources\OperatingAlgorithms\OperatingAlgorithmResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOperatingAlgorithms extends ListRecords
{
    protected static string $resource = OperatingAlgorithmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        // Редирект сразу на страницу редактирования баннера с ID = 1
        $this->redirect(static::getResource()::getUrl('edit', ['record' => 1]));
    }
}
