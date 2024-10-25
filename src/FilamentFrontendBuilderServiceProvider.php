<?php

namespace AnysiteDev\FilamentFrontendBuilder;

use AnysiteDev\FilamentFrontendBuilder\Blocks\Block;
use AnysiteDev\FilamentFrontendBuilder\Commands\MakeBlockCommand;
use AnysiteDev\FilamentFrontendBuilder\Commands\MakeLayoutCommand;
use AnysiteDev\FilamentFrontendBuilder\Facades\FilamentFrontendBuilder;
use AnysiteDev\FilamentFrontendBuilder\Layouts\Layout;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use ReflectionClass;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Symfony\Component\Finder\SplFileInfo;

class FilamentFrontendBuilderServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-frontend-builder';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews('ffb')
            ->hasTranslations()
            ->hasCommands([
                MakeLayoutCommand::class,
                MakeBlockCommand::class,
            ]);
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        $this->app->singleton('filament-frontend-builder', function () {
            return new FilamentFrontendBuilderManager;
        });
    }

    public function bootingPackage(): void
    {
        $this->registerComponentsFromDirectory(
            Layout::class,
            app_path('Filament/Frontend/Layouts'),
            'App\\Filament\\Frontend\\Layouts'
        );

        $this->registerComponentsFromDirectory(
            Block::class,
            app_path('Filament/Frontend/Blocks'),
            'App\\Filament\\Frontend\\Blocks'
        );
    }

    protected function registerComponentsFromDirectory(string $baseClass, ?string $directory, ?string $namespace): void
    {
        if (blank($directory) || blank($namespace)) {
            return;
        }

        $filesystem = app(Filesystem::class);

        if ((! $filesystem->exists($directory)) && (! Str::of($directory)->contains('*'))) {
            return;
        }

        $namespace = Str::of($namespace);

        collect($filesystem->allFiles($directory))
            ->map(function (SplFileInfo $file) use ($namespace): string {
                $variableNamespace = $namespace->contains('*') ? str_ireplace(
                    ['\\'.$namespace->before('*'), $namespace->after('*')],
                    ['', ''],
                    Str::of($file->getPath())
                        ->after(base_path())
                        ->replace(['/'], ['\\']),
                ) : null;

                return (string) $namespace
                    ->append('\\', $file->getRelativePathname())
                    ->replace('*', $variableNamespace)
                    ->replace(['/', '.php'], ['\\', '']);
            })
            ->filter(fn (string $class): bool => is_subclass_of($class, $baseClass) && (! (new ReflectionClass($class))->isAbstract()))
            ->each(fn (string $class) => FilamentFrontendBuilder::registerComponent($class, $baseClass))
            ->all();
    }
}
