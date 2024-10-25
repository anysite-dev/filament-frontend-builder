<?php

namespace AnysiteDev\FilamentFrontendBuilder\Forms\Components\Support;

use Filament\Forms;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;

final class ContentModelSelect extends Forms\Components\Select
{
    public static function make(string $name = 'type'): static
    {
        return parent::make($name)
            ->label(__('Type'))
            ->searchable()
            ->required()
            ->options(self::getContentModels());
    }

    private static function getContentModels(): array
    {
        $modelDirectory = app_path('Models');
        $namespace = 'App\\Models\\';
        $contentModels = [];

        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($modelDirectory)) as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $className = $namespace.str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    substr($file->getPathname(), strlen($modelDirectory) + 1)
                );

                if (is_subclass_of($className, 'App\\Models\\ContentBaseModel')) {
                    $shortName = (new ReflectionClass($className))->getShortName();
                    $readableName = preg_replace('/(?<!^)[A-Z]/', ' $0', $shortName);
                    $contentModels[$className] = $readableName;
                }
            }
        }

        return $contentModels;
    }
}
