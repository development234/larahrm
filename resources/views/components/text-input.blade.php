@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm transition duration-200 ' . ($disabled ? 'bg-gray-100 cursor-not-allowed' : '')
]) !!}>