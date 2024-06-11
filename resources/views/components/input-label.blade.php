@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-orange-400']) }}>
    {{ $value ?? $slot }}
</label>
