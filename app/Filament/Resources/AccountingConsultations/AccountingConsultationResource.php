<?php

namespace App\Filament\Resources\AccountingConsultations;

use App\Filament\Resources\AccountingConsultations\Pages\CreateAccountingConsultation;
use App\Filament\Resources\AccountingConsultations\Pages\EditAccountingConsultation;
use App\Filament\Resources\AccountingConsultations\Pages\ListAccountingConsultations;
use App\Filament\Resources\AccountingConsultations\Schemas\AccountingConsultationForm;
use App\Filament\Resources\AccountingConsultations\Tables\AccountingConsultationsTable;
use App\Models\AccountingConsultation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AccountingConsultationResource extends Resource
{
    protected static ?string $model = AccountingConsultation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;


    protected static ?string $navigationLabel = 'Получите помощь';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return AccountingConsultationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountingConsultationsTable::configure($table);
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
            'index' => ListAccountingConsultations::route('/'),
            'create' => CreateAccountingConsultation::route('/create'),
            'edit' => EditAccountingConsultation::route('/{record}/edit'),
        ];
    }
}
