<?php

namespace App\Filament\Resources\WhyChooseUs\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class WhyChooseUsForm
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

            // Картинка
            FileUpload::make('image')
                ->label('Изображение')
                ->disk('public')
                ->directory('why_choose_us')
                ->columnSpanFull(),

            // Пункты
            Repeater::make('items')
                ->label('Пункты')
                ->schema([
                    FileUpload::make('icon')
                        ->label('Иконка')
                        ->disk('public')
                        ->directory('why_choose_us/icons')
                        ->required(),

                    TextInput::make('text')
                        ->label('Текст (RU)'),



                    TextInput::make('text_kk')
                        ->label('Текст (KK)'),


                    TextInput::make('text_en')
                        ->label('Text (EN)')


                ])
                ->columns(1)
                ->columnSpanFull(),
        ]);
    }
}
