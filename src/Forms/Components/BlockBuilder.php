<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components;

use AnysiteDev\FilamentFrontendBuilder\Facades\FilamentFrontendBuilder;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Builder;

final class BlockBuilder extends Builder
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->hiddenLabel();

        $this->addActionLabel(__('filament-frontend-builder::block-builder.labels.add-action'));

        $this->addBetweenActionLabel(__('filament-frontend-builder::block-builder.labels.add-between-action'));

        $this->blockPreviews();

        $this->collapsible();

        $this->cloneable();

        $this->blockPickerColumns(3);

        $this->blockPickerWidth('5xl');

        $this->blockIcons();

        $this->deleteAction(
            fn (Action $action) => $action->requiresConfirmation(),
        );

        $this->editAction(
            fn (Action $action) => $action->modalSubmitActionLabel('Update'),
        );

        $this->schema(FilamentFrontendBuilder::getBlocks());
    }

    public static function make(string $name = 'blocks'): static
    {
        return parent::make($name);
    }
}
