@props(["blocks" => null])

@if(is_iterable($blocks))
	@foreach ($blocks as $block)
		@php
			$component = FilamentFrontendBuilder::getBlockFromName($block['type'])
		@endphp

		@if($component)
			<x-dynamic-component
					:component="$component::getComponent()"
					:attributes="new \Illuminate\View\ComponentAttributeBag($block['data'])"
			/>
		@endif
	@endforeach
@endif
