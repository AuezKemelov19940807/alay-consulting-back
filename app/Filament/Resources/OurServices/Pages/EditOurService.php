<?php

namespace App\Filament\Resources\OurServices\Pages;

use App\Filament\Resources\OurServices\OurServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOurService extends EditRecord
{
    protected static string $resource = OurServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
