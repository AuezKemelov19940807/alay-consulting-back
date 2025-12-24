<?php

namespace App\Filament\Resources\OperatingAlgorithms\Pages;

use App\Filament\Resources\OperatingAlgorithms\OperatingAlgorithmResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOperatingAlgorithm extends EditRecord
{
    protected static string $resource = OperatingAlgorithmResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
