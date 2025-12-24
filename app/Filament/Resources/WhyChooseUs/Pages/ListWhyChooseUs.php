<?php

namespace App\Filament\Resources\WhyChooseUs\Pages;

use App\Filament\Resources\WhyChooseUs\WhyChooseUsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhyChooseUs extends ListRecords
{
    protected static string $resource = WhyChooseUsResource::class;

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
