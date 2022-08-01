@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex space-x-2 pl-4 py-4 cursor-pointer items-center text-white bg-slate-600 border-l-8 border-slate-400 hover:bg-slate-600 duration-300'
            : 'flex space-x-2 pl-4 py-4 cursor-pointer items-center text-white hover:bg-slate-600 hover:border-l-8 hover:border-slate-400 duration-300';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>