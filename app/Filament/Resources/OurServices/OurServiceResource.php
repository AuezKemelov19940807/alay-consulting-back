<?php

namespace App\Filament\Resources\OurServices;


use App\Filament\Resources\OurServices\Pages\CreateOurService;
use App\Filament\Resources\OurServices\Pages\EditOurService;
use App\Filament\Resources\OurServices\Pages\ListOurServices;

use App\Filament\Resources\OurServices\Schemas\OurServiceForm;
use App\Filament\Resources\OurServices\Tables\OurServicesTable;
use App\Models\OurService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OurServiceResource extends Resource
{
    protected static ?string $model = OurService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $navigationLabel = 'Наши услуги';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return OurServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OurServicesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOurServices::route('/'),
            'create' => CreateOurService::route('/create'),
            'edit' => EditOurService::route('/{record}/edit'),
        ];
    }
}
