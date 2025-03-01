@pushOnce('styles')
    @vite('resources/css/components/primary-button.css')
@endpushonce

<div class="primary-button-container">
    <button 
        type="{{ $type ?? 'submit' }}"
        class="primary-button"
    >{{ $value }}</button>
</div>
