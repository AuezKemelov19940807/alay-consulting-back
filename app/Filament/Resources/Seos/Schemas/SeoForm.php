<?php

namespace App\Filament\Resources\Seos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class SeoForm
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

            // Title
            TextInput::make('title_ru')
                ->label('Title (RU)')
                ->visible(fn($get) => $get('language') === 'ru')
                ->required()
                ->columnSpanFull(),

            TextInput::make('title_kk')
                ->label('Title (KK)')
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            TextInput::make('title_en')
                ->label('Title (EN)')
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpanFull(),

            // OG Title
            TextInput::make('og_title_ru')
                ->label('OG Title (RU)')
                ->visible(fn($get) => $get('language') === 'ru')
                ->columnSpanFull(),

            TextInput::make('og_title_kk')
                ->label('OG Title (KK)')
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            TextInput::make('og_title_en')
                ->label('OG Title (EN)')
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpanFull(),

            // Description
            Textarea::make('description_ru')
                ->label('Description (RU)')
                ->rows(3)
                ->visible(fn($get) => $get('language') === 'ru')
                ->columnSpanFull(),

            Textarea::make('description_kk')
                ->label('Description (KK)')
                ->rows(3)
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            Textarea::make('description_en')
                ->label('Description (EN)')
                ->rows(3)
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpanFull(),

            // OG Description
            Textarea::make('og_description_ru')
                ->label('OG Description (RU)')
                ->rows(3)
                ->visible(fn($get) => $get('language') === 'ru')
                ->columnSpanFull(),

            Textarea::make('og_description_kk')
                ->label('OG Description (KK)')
                ->rows(3)
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            Textarea::make('og_description_en')
                ->label('OG Description (EN)')
                ->rows(3)
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpanFull(),

            // OG Image
            FileUpload::make('og_image')
                ->label('OG Image')
                ->disk('public')
                ->directory('seo')
                ->columnSpanFull(),

            // Twitter Card

            Select::make('twitter_card')
                ->label('Twitter Card')
                ->options([
                    'summary' => 'Summary',
                    'summary_large_image' => 'Summary Large Image',
                    'app' => 'App',
                    'player' => 'Player',
                ])
                ->columnSpanFull()
                ->required(false),


        ]);
    }
}
