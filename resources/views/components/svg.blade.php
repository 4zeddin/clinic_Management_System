@props(['name', 'class' => ''])

@php
    $path = resource_path("icons/{$name}.svg");
    $svgContent = file_exists($path) ? file_get_contents($path) : null;
@endphp

@if ($svgContent)
    {!! str_replace('<svg', '<svg class="' . $class . '"', $svgContent) !!}
@else
    <span>SVG not found: {{ $name }}</span>
@endif
