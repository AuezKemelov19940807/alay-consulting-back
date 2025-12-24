<?php

namespace App\Filament\Resources\OperatingAlgorithms;

use App\Filament\Resources\OperatingAlgorithms\Pages\CreateOperatingAlgorithm;
use App\Filament\Resources\OperatingAlgorithms\Pages\EditOperatingAlgorithm;
use App\Filament\Resources\OperatingAlgorithms\Pages\ListOperatingAlgorithms;
use App\Filament\Resources\OperatingAlgorithms\Schemas\OperatingAlgorithmForm;
use App\Filament\Resources\OperatingAlgorithms\Tables\OperatingAlgorithmsTable;
use App\Models\OperatingAlgorithm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OperatingAlgorithmResource extends Resource
{
    protected static ?string $model = OperatingAlgorithm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    protected static ?string $navigationLabel = 'Алгоритм работы';

    protected static ?int $navigationSort = 2;


    public static function form(Schema $schema): Schema
    {
        return OperatingAlgorithmForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OperatingAlgorithmsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }




    public static function getPages(): array
    {
        return [
            'index' => ListOperatingAlgorithms::route('/'),
            'create' => CreateOperatingAlgorithm::route('/create'),
            'edit' => EditOperatingAlgorithm::route('/{record}/edit'),
        ];
    }
}
