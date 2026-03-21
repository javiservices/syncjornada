@props(['value', 'for' => null])
<label for="{{ $for }}" {{ $attributes->merge(['class' => 'field-label']) }}>
    {{ $value ?? $slot }}
</label>
