@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex space-x-2 ml-5 pl-4 py-4 cursor-pointer items-center text-teal-500 duration-300'
            : 'flex space-x-2 ml-5 pl-4 py-4 cursor-pointer items-center text-white hover:text-teal-500 duration-300';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>