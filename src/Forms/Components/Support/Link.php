<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components\Support;

use Filament\Forms;
use Filament\Forms\Components\Component;

class Link extends Component
{
    public static function make(string $name = 'link', string $label = 'Link')
    {
        return
            Forms\Components\Fieldset::make()
                ->label($label)
                ->statePath($name)
                ->columns(1)
                ->schema([
                    Forms\Components\Toggle::make('enabled')
                        ->live(),

                    Forms\Components\Group::make()
                        ->visible(fn (Forms\Get $get) => $get('enabled'))
                        ->schema([
                            Forms\Components\Group::make()
                                ->columns(2)
                                ->schema([
                                    Forms\Components\Toggle::make('internalLink')
                                        ->default(true)
                                        ->live(),

                                    Forms\Components\Toggle::make('shouldOpenInNewWindow')
                                        ->default(false),
                                ]),

                            Forms\Components\TextInput::make('label')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\Group::make()
                                ->visible(fn (Forms\Get $get) => $get('internalLink'))
                                ->columns(12)
                                ->schema([
                                    ContentModelSelect::make()
                                        ->columnSpan(4),

                                    Forms\Components\Select::make('model_id')
                                        ->label('Destination')
                                        ->columnSpan(8)
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->options(fn (Forms\Get $get) => $get('type') ? $get('type')::pluck('title', 'id') : []),
                                ]),

                            Forms\Components\TextInput::make('url')
                                ->visible(fn (Forms\Get $get) => ! $get('internalLink')),
                        ]),
                ]);
    }
}
