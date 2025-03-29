<div class="
    flex items-center
    p-very-large gap-normal
    shadow-default
">
    <x-profile :user="$user" />
    <p class="
        flex items-center
        gap-normal
    ">
        {{ $user->name }} <span class="circle"></span> 
        @if ($role == 'players')
            <img src="/local/{{ $user->getClubIcon() }}" alt="{{ $user->name }}_club_icon" class="club-icon">
        @elseif ($role == 'scouts')
            {{ $user->getAge() }}
        @endif
    </p>
</div>