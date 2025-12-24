<?php

namespace App\Filament\Resources\Banners;

use App\Filament\Resources\Banners\Pages\EditBanner;
use App\Filament\Resources\Banners\Pages\ListBanners;
use App\Filament\Resources\Banners\Schemas\BannerForm;
use App\Filament\Resources\Banners\Tables\BannersTable;
use App\Models\Banner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    // Название в навигации
    protected static ?string $navigationLabel = 'Баннер';

    protected static ?int $navigationSort = 1;

    // Иконка
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    public static function form(Schema $schema): Schema
    {
        return BannerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BannersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getBreadcrumb(): string
    {
        return 'Баннер';
    }

    public static function getPluralLabel(): string
    {
        return 'Баннер';
    }

    public static function getLabel(): string
    {
        return 'Баннер';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBanners::route('/'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }

}
