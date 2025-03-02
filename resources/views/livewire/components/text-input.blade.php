@pushOnce('styles')
    @vite('resources/css/components/input.css')
@endpushonce

<div class="input-container">
    @if (isset($label)) 
        <label for="input">{{ $label }}</label>
    @endif
    <input 
        type="text" 
        class="input" 
        placeholder="{{ $placeholder ?? '' }}"
        @if (isset($model))
            wire:model.live="$parent.{{ $model }}"
        @endif
    />
</div>
