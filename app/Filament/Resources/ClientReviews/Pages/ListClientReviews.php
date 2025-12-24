<?php

namespace App\Filament\Resources\ClientReviews\Pages;

use App\Filament\Resources\ClientReviews\ClientReviewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClientReviews extends ListRecords
{
    protected static string $resource = ClientReviewResource::class;

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
