@pushOnce('styles')
    @vite('resources/css/components/input.css')
    @vite('resources/css/components/image-input.css')
@endpushonce

<div class="image-input-container input-container">
    @if (isset($label))
        <label for="image-input">{{ $label }}</label>
    @endif
    
    <input 
        type="file"
        class="image-input"
        accept="image/*"
        @if (isset($model))
            wire:model.live="$parent.{{ $model }}"
        @endif
    >

    <figure class="image-container">
        {{ svg('iconsax-bul-profile-circle') }}
    </figure>
</div>

@pushOnce('scripts')
    @vite('resources/js/components/image-input.js')
@endPushOnce