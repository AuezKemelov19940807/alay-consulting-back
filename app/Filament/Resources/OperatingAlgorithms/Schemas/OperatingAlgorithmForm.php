<?php

namespace App\Filament\Resources\OperatingAlgorithms\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class OperatingAlgorithmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // Языки
            ToggleButtons::make('language')
                ->label('Язык')
                ->options([
                    'ru' => 'RU',
                    'kk' => 'KK',
                    'en' => 'EN',
                ])
                ->inline()
                ->reactive()
                ->afterStateHydrated(function ($component, $state, $record) {
                    if (!$state) {
                        if ($record->title_ru) {
                            $component->state('ru');
                        } elseif ($record->title_en) {
                            $component->state('en');
                        } else {
                            $component->state('kk');
                        }
                    }
                })
                ->columnSpan('full'),

            FileUpload::make('image')
                ->label('Изображение')
                ->image()
                ->disk('public')
                ->directory('operating-algorithm')
                ->imagePreviewHeight(60),

            // Заголовок
            TextInput::make('title')
                ->label('Заголовок (RU)')
                ->visible(fn ($get) => $get('language') === 'ru')
                ->required(),

            TextInput::make('title_kk')
                ->label('Заголовок (KK)')
                ->visible(fn ($get) => $get('language') === 'kk'),

            TextInput::make('title_en')
                ->label('Title (EN)')
                ->visible(fn ($get) => $get('language') === 'en'),

            // Описание
            Textarea::make('description')
                ->label('Описание (RU)')
                ->visible(fn ($get) => $get('language') === 'ru'),

            Textarea::make('description_kk')
                ->label('Описание (KK)')
                ->visible(fn ($get) => $get('language') === 'kk'),

            Textarea::make('description_en')
                ->label('Description (EN)')
                ->visible(fn ($get) => $get('language') === 'en'),

            // 🔥 STEPS (JSON)
            Repeater::make('steps')
                ->label('Шаги')
                ->schema([

                    TextInput::make('order')
                        ->label('№')
                        ->numeric()
                        ->required(),

                    TextInput::make('order')
                        ->numeric()
                        ->required(),

                    TextInput::make('title')
                        ->label('Заголовок (RU)')
                        ->columnSpanFull(),

                    TextInput::make('title_kk')
                        ->label('Заголовок (KK)')
                        ->columnSpanFull(),

                    TextInput::make('title_en')
                        ->label('Title (EN)')
                        ->columnSpanFull(),
                ])
                ->columns(4)
                ->defaultItems(3)
                ->reorderable()
                ->columnSpan('full'),
        ]);
    }
}
