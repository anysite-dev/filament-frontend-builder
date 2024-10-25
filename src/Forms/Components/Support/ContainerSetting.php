<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components\Support;

use Filament\Forms;
use Filament\Forms\Components\Component;

final class ContainerSetting extends Component
{
    public static function make(
        string $name = 'container',
        string $defaultPaddingTop = 'md',
        bool $lockPaddingTop = false,
        string $defaultPaddingBottom = 'md',
        bool $lockBottomPadding = false,
        string $defaultWidth = '7xl',
        bool $lockWidth = false,
    ) {
        return Forms\Components\Fieldset::make()
            ->label(__('Container'))
            ->columns(3)
            ->statePath($name)
            ->schema([
                Forms\Components\Select::make('paddingTop')
                    ->placeholder(__('Padding top'))
                    ->required()
                    ->default($defaultPaddingTop)
                    ->disabled($lockPaddingTop)
                    ->dehydrated()
                    ->options([
                        'none' => 'none',
                        'sm' => 'small',
                        'md' => 'medium',
                        'lg' => 'large',
                        'xl' => 'extra large',
                    ]),

                Forms\Components\Select::make('paddingBottom')
                    ->placeholder(__('Padding bottom'))
                    ->required()
                    ->default($defaultPaddingBottom)
                    ->disabled($lockBottomPadding)
                    ->dehydrated()
                    ->options([
                        'none' => 'none',
                        'sm' => 'small',
                        'md' => 'medium',
                        'lg' => 'large',
                        'xl' => 'extra large',
                    ]),

                Forms\Components\Select::make('maxContentWidth')
                    ->placeholder(__('Width'))
                    ->default($defaultWidth)
                    ->disabled($lockWidth)
                    ->dehydrated()
                    ->required()
                    ->columns(1)
                    ->options([
                        'sm' => 'sm',
                        'md' => 'md',
                        'lg' => 'lg',
                        'xl' => 'xl',
                        '2xl' => '2xl',
                        '3xl' => '3xl',
                        '4xl' => '4xl',
                        '5xl' => '5xl',
                        '6xl' => '6xl',
                        '7xl' => '7xl',
                        'full' => 'full',
                    ]),
            ]);
    }
}
