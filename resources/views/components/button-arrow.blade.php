<button {{ $attributes->merge(['class' => 'costum-btn']) }}>
    {{ $slot }} <i class="{{ $icon ?? 'bi bi-arrow-right' }}"></i>
</button>
