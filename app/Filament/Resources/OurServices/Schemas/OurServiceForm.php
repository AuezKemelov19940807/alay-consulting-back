<?php

namespace App\Filament\Resources\OurServices\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class OurServiceForm
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

            // Заголовок блока
            TextInput::make('title')
                ->label('Заголовок (RU)')
                ->visible(fn($get) => $get('language') === 'ru')
                ->columnSpanFull(),




            TextInput::make('title_kk')
                ->label('Заголовок (KK)')
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            TextInput::make('title_en')
                ->label('Заголовок (EN)')
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpanFull(),

            // Услуги
            Repeater::make('data.items')
                ->label('Услуги')
                ->reactive()
                ->columns(2) // Две колонки для повторителя
                ->schema([

                    TextInput::make('id')
                        ->numeric()
                        ->hidden(),

                    // ===== Левая колонка =====
                    TextInput::make('title.ru')
                        ->label('Название (RU)')

                        ->columnSpan(1),


                    // ===== Левая колонка =====
                    TextInput::make('title.en')
                        ->label('Название (EN)')

                        ->columnSpan(1),

                    // ===== Левая колонка =====
                    TextInput::make('title.kk')
                        ->label('Название (KK)')

                        ->columnSpan(1),

                    FileUpload::make('icon')
                        ->label('Иконка услуги')
                        ->disk('public')
                        ->directory('our_services')
                        ->columnSpan(1),

                    FileUpload::make('subtitle.icon')
                        ->label('Иконка подпунктов')
                        ->disk('public')
                        ->directory('our_services')
                        ->columnSpan(1),

                    // ===== Правая колонка =====
                    Repeater::make('subtitle.items')
                        ->label('Подпункты')
                        ->default([]) // важно!
                        ->schema([
                            TextInput::make('title.ru')
                                ->label('Подпункт (RU)')
                                ->columnSpan(1)
                            ,
                            TextInput::make('title.kk')->label('Подпункт (KK)'),
                            TextInput::make('title.en')->label('Подпункт (EN)'),
                        ])
                        ->columns(1)

                       // чтобы Repeater занимал всю правую колонку
                ])
                ->columnSpan('full')
                ->collapsible()
                ->reorderable()
                ->addActionLabel('Добавить услугу')
        ]);
    }
}
