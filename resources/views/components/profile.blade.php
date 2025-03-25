@pushOnce('styles')
    @vite('resources/css/components/profile.css')
@endPushOnce

<div class="profile">
    @if ($user->avatar)
    <figure>
        <img src="/local/{{ $user->avatar }}" alt="{{ $user->name }}">
    </figure>
    @else
        <x-css-profile />
    @endif
</div>