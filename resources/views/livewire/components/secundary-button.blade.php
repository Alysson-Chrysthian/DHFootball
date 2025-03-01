@pushOnce('styles')
    @vite('resources/css/components/primary-button.css')
    @vite('resources/css/components/secundary-button.css')
@endpushonce

<div>
    <button 
        type="{{ $type ?? 'submit' }}"
        class="secundary-button primary-button"
    >{!! $value !!}</button>
</div>
