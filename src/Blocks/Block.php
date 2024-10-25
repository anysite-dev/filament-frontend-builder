<?php

namespace AnysiteDev\FilamentFrontendBuilder\Blocks;

use Filament\Forms\Components\Builder\Block as FilamentBlock;

abstract class Block
{
    protected static ?string $component;

    abstract public static function getBlockSchema(): FilamentBlock;

    public static function getComponent(): string
    {
        if (isset(static::$component)) {
            return static::$component;
        }

        return 'blocks.'.static::getName();
    }

    public static function getName(): string
    {
        return static::getBlockSchema()->getName();
    }
}
