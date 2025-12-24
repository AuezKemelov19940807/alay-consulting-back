<?php

namespace App\Filament\Resources\AccountingConsultations\Pages;

use App\Filament\Resources\AccountingConsultations\AccountingConsultationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccountingConsultation extends EditRecord
{
    protected static string $resource = AccountingConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
