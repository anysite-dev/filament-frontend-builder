<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components;

use AnysiteDev\FilamentFrontendBuilder\Facades\FilamentFrontendBuilder;
use Filament\Forms\Components\Select;

final class LayoutSelect extends Select
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-frontend-builder::layout-select.label'));

        $this->options(FilamentFrontendBuilder::getLayouts());
        $this->default(fn () => FilamentFrontendBuilder::getDefaultLayoutName());
        $this->required();
    }

    public static function make(string $name = 'layout'): static
    {
        return parent::make($name);
    }
}
