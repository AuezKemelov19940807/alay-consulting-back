<?php

namespace App\Filament\Resources\ClientReviews\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class ClientReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // Выбор языка
            ToggleButtons::make('language')
                ->label('Язык')
                ->options([
                    'ru' => 'RU',
                    'kk' => 'KK',
                    'en' => 'EN',
                ])
                ->inline()
                ->reactive()
                ->default('ru')
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
                }),

            // Заголовок
            TextInput::make('title')
                ->label('Заголовок (RU)')
                ->visible(fn($get) => $get('language') === 'ru')
                ->required()
                ->columnSpanFull(),

            TextInput::make('title_kk')
                ->label('Заголовок (KK)')
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            TextInput::make('title_en')
                ->label('Заголовок (EN)')
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpanFull(),

            // Пункты (Отзывы)
            Repeater::make('items')
                ->label('Отзывы')
                ->schema([
                    TextInput::make('fullname')
                        ->label('Имя (RU)')
                        ->visible(fn($get) => $get('../../language') === 'ru')
                        ->required(),

                    TextInput::make('fullname_kk')
                        ->label('Имя (KK)')
                        ->visible(fn($get) => $get('../../language') === 'kk'),

                    TextInput::make('fullname_en')
                        ->label('Имя (EN)')
                        ->visible(fn($get) => $get('../../language') === 'en'),

                    TextInput::make('text')
                        ->label('Текст (RU)')
                        ->visible(fn($get) => $get('../../language') === 'ru')
                        ->required(),

                    TextInput::make('text_kk')
                        ->label('Текст (KK)')
                        ->visible(fn($get) => $get('../../language') === 'kk'),

                    TextInput::make('text_en')
                        ->label('Текст (EN)')
                        ->visible(fn($get) => $get('../../language') === 'en'),
                ])
                ->columns(1)
                ->columnSpanFull(),
        ]);
    }
}
