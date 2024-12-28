@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm tracking-wider text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
