<div class="card" style="color: {{ $color }}; background-color: {{ $bgColor }};">
    <div class="card-header">{{ $header }}</div>
    @if ($slot->isEmpty())
        <p>Please add content to the card</p>
    @else
        {{ $slot }}
    @endif
    <div class="card-footer">{{ $footer }}</div>
</div>