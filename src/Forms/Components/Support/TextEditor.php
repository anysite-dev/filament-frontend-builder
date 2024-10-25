<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components\Support;

use Filament\Forms\Components\RichEditor;

class TextEditor extends RichEditor
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Text'));

        $this->toolbarButtons([
            'blockquote',
            'bold',
            'bulletList',
            'italic',
            'link',
            'orderedList',
            'strike',
            'underline',
            'redo',
            'undo',
        ]);
    }

    public static function make(string $name = 'text'): static
    {
        return parent::make($name);
    }
}
