<?php

namespace App\Filament\Resources\Footers\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class FooterForm
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

            // Текст футера
            Textarea::make('text')
                ->label('Текст (RU)')
                ->rows(2)
                ->visible(fn($get) => $get('language') === 'ru')
                ->required()
                ->columnSpanFull(),

            Textarea::make('text_kk')
                ->label('Текст (KK)')
                ->rows(2)
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            Textarea::make('text_en')
                ->label('Текст (EN)')
                ->rows(2)
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpanFull(),

            // Меню футера
            Repeater::make('menu')
                ->label('Меню')
                ->schema([
                    TextInput::make('label.ru')->label('Название (RU)')->visible(fn($get) => $get('../../language') === 'ru')->required(),
                    TextInput::make('label.kk')->label('Название (KK)')->visible(fn($get) => $get('../../language') === 'kk'),
                    TextInput::make('label.en')->label('Название (EN)')->visible(fn($get) => $get('../../language') === 'en'),
                    TextInput::make('url')->label('Ссылка')->required(),
                ])
                ->columns(1)
                ->defaultItems(1)
                ->collapsible()
                ->reorderable()
                ->addActionLabel('Добавить пункт меню')
                ->columnSpanFull(),

            // Соцсети с FileUpload
            Repeater::make('socials')
                ->label('Соцсети')
                ->schema([
                    FileUpload::make('icon')
                        ->label('Иконка соцсети')
                        ->disk('public')
                        ->directory('footer/socials')
                        ->columnSpanFull()
                        ->required(),

                    TextInput::make('url')
                        ->label('Ссылка')
                        ->required(),
                ])
                ->columns(1)
                ->defaultItems(1)
                ->collapsible()
                ->reorderable()
                ->addActionLabel('Добавить соцсеть')
                ->columnSpanFull(),
        ]);
    }
}
