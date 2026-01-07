<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // Активность
            ToggleButtons::make('is_active')
                ->label('Активность')
                ->options([
                    true => 'Да',
                    false => 'Нет',
                ])
                ->inline()
                ->columnSpan('full'),

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
                ->default('ru')
                ->afterStateHydrated(function ($component, $state, $record) {
                    if (!$state) {
                        if ($record->title_en) {
                            $component->state('en');
                        } elseif ($record->title_ru) {
                            $component->state('ru');
                        } else {
                            $component->state('kk');
                        }
                    }
                })
                ->columnSpan('full'),

            // Заголовки
            TextInput::make('title')->label('Заголовок (RU)')
                ->visible(fn($get) => $get('language') === 'ru')
                ->required()
                ->columnSpan('full'),
            TextInput::make('title_kk')->label('Заголовок (KK)')
                ->visible(fn($get) => $get('language') === 'kk')
                ->required()
                ->columnSpan('full'),
            TextInput::make('title_en')->label('Title (EN)')
                ->visible(fn($get) => $get('language') === 'en')
                ->required()
                ->columnSpan('full'),

            // Описание
            TextInput::make('description')->label('Описание (RU)')
                ->visible(fn($get) => $get('language') === 'ru')
                ->columnSpan('full'),
            TextInput::make('description_kk')->label('Описание (KK)')
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpan('full'),
            TextInput::make('description_en')->label('Description (EN)')
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpan('full'),

            // Текст кнопки
            TextInput::make('button_text')->label('Текст кнопки (RU)')
                ->visible(fn($get) => $get('language') === 'ru')
                ->columnSpan('full'),
            TextInput::make('button_text_kk')->label('Текст кнопки (KK)')
                ->visible(fn($get) => $get('language') === 'kk')
                ->columnSpan('full'),
            TextInput::make('button_text_en')->label('Button text (EN)')
                ->visible(fn($get) => $get('language') === 'en')
                ->columnSpan('full'),


            Repeater::make('features')
                ->relationship('features')
                ->reactive()
                ->schema([
                    TextInput::make('text')
                        ->label('Текст (RU)')
                        ->required()
                        ->visible(fn($get) => $get('../../language') === 'ru')
                        ->columnSpan('full'),


                    TextInput::make('text_kk')
                        ->label('Текст (KK)')
                        ->visible(fn($get) => $get('../../language') === 'kk')
                        ->columnSpan('full'),

                    TextInput::make('text_en')
                        ->label('Text (EN)')
                        ->visible(fn($get) => $get('../../language') === 'en')
                        ->columnSpan('full'),
                    FileUpload::make('icon')
                        ->label('Иконка')
                        ->image()
                        ->disk('public')
                        ->directory('features')
                        ->visibility('public')
                        ->imagePreviewHeight(50)
                        ->multiple(false)
                        ->nullable()
                        ->dehydrated()
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file) => uniqid().'_'.$file->getClientOriginalName()
                        )
                ])
                ->columns(4)
                ->columnSpan('full'),


            Repeater::make('sliders')
                ->relationship('sliders')
                ->schema([

                    TextInput::make('title')
                        ->label('Заголовок (RU)')
                        ->visible(fn($get) => $get('../../language') === 'ru')
                        ->required()
                        ->columnSpan('full'),

                    TextInput::make('title_kk')
                        ->label('Заголовок (KK)')
                        ->visible(fn($get) => $get('../../language') === 'kk')
                        ->required()
                        ->columnSpan('full'),

                    TextInput::make('title_en')
                        ->label('Title (EN)')
                        ->visible(fn($get) => $get('../../language') === 'en')
                        ->required()
                        ->columnSpan('full'),

                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image()
                        ->disk('public')
                        ->directory('banners')
                        ->required(),
                ])
                ->columns(4)
                ->columnSpan('full')
        ]);
    }
}
