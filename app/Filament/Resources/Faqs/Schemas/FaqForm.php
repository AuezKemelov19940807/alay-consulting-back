<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /* ===== Выбор языка ===== */
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

            /* ===== Заголовок ===== */
            TextInput::make('title')
                ->label('Заголовок (RU)')
                ->visible(fn ($get) => $get('language') === 'ru')
                ->required()
                ->columnSpanFull(),

            TextInput::make('title_kk')
                ->label('Заголовок (KK)')
                ->visible(fn ($get) => $get('language') === 'kk')
                ->columnSpanFull(),

            TextInput::make('title_en')
                ->label('Заголовок (EN)')
                ->visible(fn ($get) => $get('language') === 'en')
                ->columnSpanFull(),

            /* ===== FAQ Items ===== */
            Repeater::make('items')
                ->label('Вопросы и ответы')
                ->schema([

                    /* Вопрос */
                    TextInput::make('question.ru')
                        ->label('Вопрос (RU)')

                        ->required(),

                    TextInput::make('question.kk')
                        ->label('Вопрос (KK)'),


                    TextInput::make('question.en')
                        ->label('Вопрос (EN)'),

                    Textarea::make('answer.ru')
                        ->label('Ответ (RU)')
                        ->rows(3)

                        ->required(),

                    Textarea::make('answer.kk')
                        ->label('Ответ (KK)')
                        ->rows(3),

                    Textarea::make('answer.en')
                        ->label('Ответ (EN)')
                        ->rows(3),
                ])
                ->columns(1)
                ->columnSpanFull()
                ->defaultItems(1)
                ->collapsible()
                ->reorderable()
                ->addActionLabel('Добавить вопрос'),
        ]);
    }
}
