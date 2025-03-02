@pushOnce('styles')
    @vite('resources/css/components/input.css')
@endpushonce

<div class="input-container">
    @if (isset($label))
        <label>{{ $label }}</label>
    @endif
    <input 
        type="date"
        class="input"
        @if (isset($model))
            wire:model.live="$parent.{{ $model }}"        
        @endif
    />
</div>
