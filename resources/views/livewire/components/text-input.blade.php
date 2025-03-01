@pushOnce('styles')
    @vite('resources/css/components/text-input.css')
@endpushonce

<div class="text-input-container">
    @if (isset($label)) 
        <label for="text-input">{{ $label }}</label>
    @endif
    <input 
        type="text" 
        class="text-input" 
        placeholder="{{ $placeholder ?? '' }}"
        @if (isset($model))
            wire:model.live="$parent.{{ $model }}"
        @endif
    />
</div>
