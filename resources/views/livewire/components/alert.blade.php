@pushOnce('styles')
    @vite('resources/css/components/alert.css')
@endPushOnce

<div class="alert-container">
    <p>{{ $message ?? "" }}</p>
</div>

@pushOnce('scripts')
    @vite('resources/js/components/alert.js')
@endPushOnce