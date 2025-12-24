<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBanners extends ListRecords
{
    protected static string $resource = BannerResource::class;

    // убираем static
    protected string $view = 'filament.redirect-banner';

    public function mount(): void
    {
        // Редирект сразу на страницу редактирования баннера с ID = 1
        $this->redirect(static::getResource()::getUrl('edit', ['record' => 1]));
    }
}
