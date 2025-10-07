<div class="card {{ $class ?? '' }}">
    @isset($header)
    <div class="card-title bg-light px-3 pb-1 pt-2 border-bottom">
        {{ $header }}
    </div>
    @endisset

    <div class="card-body p-3 pt-1">
        {{ $slot }}
    </div>
</div>