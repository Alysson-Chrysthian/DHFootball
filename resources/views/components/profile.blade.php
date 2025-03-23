@pushOnce('styles')
    @vite('resources/css/components/profile.css')
@endPushOnce

<div class="profile">
    @if ($player->avatar)
    <figure>
        <img src="/local/{{ $player->avatar }}" alt="{{ $player->name }}">
    </figure>
    @else
        <x-css-profile />
    @endif
</div>