<button {{ $attributes->merge(['class' => 'animated-btn bottom']) }}
    style="--btn-color: {{ $color ?? 'red' }}; --btn-hover-color: {{ $hovColor ?? 'white' }};">
    {{ $slot }}
    @if (isset($icon))
        <i class="{{ $icon }}"></i>
    @endif
    <span class="bg"></span>
</button>

<style>
    .animated-btn {
        background-color: transparent;
        color: var(--btn-color);
        border: 1px solid var(--btn-color);
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        position: relative;
        cursor: pointer;
        z-index: 1;
        overflow: hidden;
        transition: all .5s ease-in-out;
    }

    .animated-btn>span.bg {
        background: var(--btn-color);
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: -1;
        transition: all .3s ease-in-out;
    }

    .animated-btn:hover {
        color: var(--btn-hover-color);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .animated-btn.bottom>.bg {
        left: 0;
        bottom: 100%;
        transform: translateY(200%);
    }

    .animated-btn.bottom:hover>.bg {
        transform: translateY(100%);
    }
</style>
