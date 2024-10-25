@props([
    "maxContentWidth" => null,
    "fullHeight" => false,
    "padding" => true,
    "verticalPadding" => true,
   	"paddingTop" => "md",
    "paddingBottom" => "md",
])

@php
	use Filament\Support\Enums\MaxWidth;
@endphp

<div {{ $attributes->class(["h-full" => $fullHeight]) }}>
	<div @class([
            "mx-auto h-full w-full",
            "px-4 md:px-6 lg:px-8" => $padding,
            match ($paddingTop) {
            	"none" => "",
				"sm" => "pt-6 sm:pt-8 lg:pt-10",
				"md" => "pt-12 sm:pt-16 lg:pt-20",
				"lg" => "pt-24 sm:pt-32 lg:pt-40",
				"xl" => "pt-40 sm:pt-48 lg:pt-56"
            },
            match ($paddingBottom) {
            	"none" => "",
				"sm" => "pb-6 sm:pb-8 lg:pb-10",
				"md" => "pb-12 sm:pb-16 lg:pb-20",
				"lg" => "pb-24 sm:pb-32 lg:pb-40",
				"xl" => "pb-40 sm:pb-48 lg:pb-56"
            },
            match ($maxContentWidth ??= MaxWidth::SevenExtraLarge) {
                MaxWidth::ExtraSmall, "xs" => "max-w-xs",
                MaxWidth::Small, "sm" => "max-w-sm",
                MaxWidth::Medium, "md" => "max-w-md",
                MaxWidth::Large, "lg" => "max-w-lg",
                MaxWidth::ExtraLarge, "xl" => "max-w-xl",
                MaxWidth::TwoExtraLarge, "2xl" => "max-w-2xl",
                MaxWidth::ThreeExtraLarge, "3xl" => "max-w-3xl",
                MaxWidth::FourExtraLarge, "4xl" => "max-w-4xl",
                MaxWidth::FiveExtraLarge, "5xl" => "max-w-5xl",
                MaxWidth::SixExtraLarge, "6xl" => "max-w-6xl",
                MaxWidth::SevenExtraLarge, "7xl" => "max-w-7xl",
                MaxWidth::Full, "full" => "max-w-full",
                MaxWidth::MinContent, "min" => "max-w-min",
                MaxWidth::MaxContent, "max" => "max-w-max",
                MaxWidth::FitContent, "fit" => "max-w-fit",
                MaxWidth::Prose, "prose" => "max-w-prose",
                MaxWidth::ScreenSmall, "screen-sm" => "max-w-screen-sm",
                MaxWidth::ScreenMedium, "screen-md" => "max-w-screen-md",
                MaxWidth::ScreenLarge, "screen-lg" => "max-w-screen-lg",
                MaxWidth::ScreenExtraLarge, "screen-xl" => "max-w-screen-xl",
                MaxWidth::ScreenTwoExtraLarge, "screen-2xl" => "max-w-screen-2xl",
                default => $maxContentWidth,
            },
        ])>
		{{ $slot }}
	</div>
</div>
