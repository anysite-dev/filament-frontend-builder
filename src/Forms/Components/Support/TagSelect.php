<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components\Support;

use Filament\Forms\Components\Select;

final class TagSelect extends Select
{
    public static function make(
        string $name = 'heading_tag',
        string $label = 'Heading tag',
        bool $required = true,
        string $default = 'h2',
    ): static {
        return parent::make($name)
            ->translateLabel()
            ->label($label)
            ->required($required)
            ->default($default)
            ->options([
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
                'p' => 'p',
                'div' => 'div',
            ]);
    }
}
