<?php

namespace AnysiteDev\FilamentFrontendBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getBlocks()
 *
 * @see \AnysiteDev\FilamentFrontendBuilder\FilamentFrontendBuilderManager
 */
class FilamentFrontendBuilder extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'filament-frontend-builder';
    }
}
