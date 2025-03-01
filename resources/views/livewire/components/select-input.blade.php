@pushOnce('styles')
    @vite('resources/css/components/input.css')
@endPushOnce

<div class="input-container">
    @if (isset($label))
        <label for="input">{{ $label }}</label>
    @endif

    <select 
        class="input" 
        @if (isset($model))
            wire:model.live="$parent.{{ $model }}"
        @endif
    >
        @if (isset($placeholder))
            <option selected>{{ $placeholder }}</option>
        @endif

        @foreach ($options as $value => $option)
            <option value="{{ $value }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
