@props(['label', 'name', 'padding' => 'px-5 py-4', 'radius' => 'rounded-xl'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => "$radius bg-white/10 border border-white/10 w-full $padding"
    ];
@endphp

<x-forms.field :$label :$name>
    <select {{ $attributes($defaults) }}> <!--dropdown-->
        {{ $slot }}
    </select>
</x-forms.field>

