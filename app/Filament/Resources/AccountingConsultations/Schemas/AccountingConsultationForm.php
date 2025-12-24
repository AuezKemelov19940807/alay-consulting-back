<?php

namespace App\Filament\Resources\AccountingConsultations\Schemas;

use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AccountingConsultationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

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

            // RU
            TextInput::make('title')
                ->label('Заголовок')
                ->required()
                ->visible(fn ($get) => $get('language') === 'ru')
                ->columnSpanFull(),

            Textarea::make('description')
                ->label('Описание')
                ->rows(4)
                ->visible(fn ($get) => $get('language') === 'ru')
                ->columnSpanFull(),

            TextInput::make('button_text')
                ->label('Текст кнопки')
                ->visible(fn ($get) => $get('language') === 'ru'),

            // KK
            TextInput::make('title_kk')
                ->label('Заголовок (KK)')
                ->visible(fn ($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            Textarea::make('description_kk')
                ->label('Описание (KK)')
                ->rows(4)
                ->visible(fn ($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            TextInput::make('button_text_kk')
                ->label('Текст кнопки (KK)')
                ->visible(fn ($get) => $get('language') === 'kk'),

            // EN
            TextInput::make('title_en')
                ->label('Заголовок (EN)')
                ->visible(fn ($get) => $get('language') === 'en')
                ->columnSpanFull(),

            Textarea::make('description_en')
                ->label('Описание (EN)')
                ->rows(4)
                ->visible(fn ($get) => $get('language') === 'en')
                ->columnSpanFull(),

            TextInput::make('button_text_en')
                ->label('Текст кнопки (EN)')
                ->visible(fn ($get) => $get('language') === 'en'),

        ]);
    }
}
