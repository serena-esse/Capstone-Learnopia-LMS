@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-green-300 focus:ring-green-300 rounded-md shadow-sm']) !!}>
