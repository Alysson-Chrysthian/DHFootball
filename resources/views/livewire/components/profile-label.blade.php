@pushOnce('styles')
    @vite('resources/css/components/profile-label.css')
@endPushOnce

<div class="profile-label-container">
    @if (isset($source))
        <img src="{{ $source }}">
    @else
        {{ svg('iconsax-bul-profile-circle') }}
    @endif
</div>

@pushOnce('scripts')
    @vite('resources/js/components/profile-label.js')
@endPushOnce