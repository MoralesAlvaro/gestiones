<div class="z-40">
    <div lass="z-40">
        @if (session()->has('info'))
        <x-alert-info></x-alert-info>
        @endif
    </div>

    <div lass=" z-40">
        @if (session()->has('warning'))
            <x-alert-warning></x-alert-warning>
        @endif
    </div>
</div>
