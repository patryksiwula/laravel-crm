@props(['color'])

@php
	$backgrounds = [
		'slate' => 'bg-slate-200',
		'green' => 'bg-green-200',
		'orange' => 'bg-orange-200',
		'red' => 'bg-red-200',
		'yellow' => 'bg-yellow-200',
		'teal' => 'bg-teal-200',
		'lime' => 'bg-lime-200'
	];

	$textColors = [
		'slate' => 'text-slate-600',
		'green' => 'text-green-600',
		'orange' => 'text-orange-600',
		'red' => 'text-red-600',
		'yellow' => 'text-yellow-600',
		'teal' => 'text-teal-600',
		'lime' => 'text-lime-600'
	];

	$borderColors = [
		'slate' => 'border-slate-600',
		'green' => 'border-green-600',
		'orange' => 'border-orange-600',
		'red' => 'border-red-600',
		'yellow' => 'border-yellow-600',
		'teal' => 'border-teal-600',
		'lime' => 'border-lime-600'
	];

	$classes = "px-3 py-1 text-xs rounded-full font-bold border $backgrounds[$color] $textColors[$color] $borderColors[$color]";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</span>