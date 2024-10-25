<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components\Support;

use Filament\Forms;
use Filament\Forms\Components\Component;

final class Heading extends Component
{
    public static function make(
        string $name = 'heading',
        string $label = 'Heading',
        string $defaultTag = 'h1',
        bool $required = true,
    ) {
        return Forms\Components\Group::make()
            ->columns(12)
            ->statePath($name)
            ->schema([
                Forms\Components\TextInput::make('text')
                    ->translateLabel()
                    ->label($label)
                    ->columnSpan(['lg' => 10])
                    ->required($required)
                    ->maxLength(255),

                TagSelect::make(name: 'tag', label: 'Tag', required: $required, default: $defaultTag)
                    ->columnSpan(['lg' => 2]),
            ]);
    }
}
