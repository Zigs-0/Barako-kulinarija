@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-6 pt-1 border-b-2 border-pink-500 text-lg font-bold leading-5 text-gray-100 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-6 pt-1 border-b-2 border-transparent text-lg font-bold leading-5 text-gray-300 hover:text-pink-400 hover:border-pink-400 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>