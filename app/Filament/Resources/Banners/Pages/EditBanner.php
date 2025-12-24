<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    public function getBreadcrumb(): string
    {
        return 'Редактировать';
    }

    public function getTitle(): string
    {
        return 'Редактировать баннер';
    }
}
