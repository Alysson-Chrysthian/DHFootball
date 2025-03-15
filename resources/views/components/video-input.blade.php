<div class="flex flex-col">
    @if ($label)
        <label for="{{ $attributes->get('id') }}">{{ $label }}</label>
    @endif
    <x-button
        type="button"
        class="upload-video-button"
    >
        <x-ri-upload-2-line 
            class="w-6 h-6"
        />
    </x-button>
    <input 
        {{ 
            $attributes->merge([
                'type' => 'file',
                'accept' => 'video/*',
                'class' => 'hidden',
            ]) 
        }}
    />
</div>

@pushOnce('scripts')
    <script>
        uploadVideoButtons = document.querySelectorAll('.upload-video-button');

        uploadVideoButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const uploadVideoInput = button.parentElement.nextElementSibling;
                uploadVideoInput.click();
            });
        });
    </script>
@endPushOnce
