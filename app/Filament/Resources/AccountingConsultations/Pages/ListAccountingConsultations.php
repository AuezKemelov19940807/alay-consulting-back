<?php

namespace App\Filament\Resources\AccountingConsultations\Pages;

use App\Filament\Resources\AccountingConsultations\AccountingConsultationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccountingConsultations extends ListRecords
{
    protected static string $resource = AccountingConsultationResource::class;

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
