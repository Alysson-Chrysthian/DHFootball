@pushOnce('styles')
    @vite('resources/css/components/edit-text-input.css')
@endPushOnce

<div class="flex flex-col {{ $attributes->get('class') }}">
    @error($attributes->get('wire:model.live') ?? $attributes->get('wire:model.blur'))
        <span class="error">{{ $message }}</span>
    @enderror

    @if ($label)
        <label for="{{ $attributes->get('id') }}">{{ $label }}</label>
    @endif    
    
    <div class="
        edit-text-input-container
        flex items-center
        rounded-default
        shadow-default
        overflow-hidden
        relative
    ">
        <input
            {{
                $attributes->merge([
                    'type' => 'text',
                    'class' => '
                        edit-text-input
                        p-small
                        outline-none
                        rounded-default
                        bg-light text-dark
                        placeholder:text-dark
                        w-full
                    '
                ])
            }}
            @disabled(true)
        />
        <div class="
            edit-text-button-container
            absolute 
            right-0
            rounded-default
            p-small
            cursor-pointer
            hover:bg-secundary
            hover:text-light
        ">
            <x-ri-edit-line class="w-6 h-6" />
        </div>
        <div class="
            focus-container
            absolute
            w-full h-full    
            bg-secundary
            rounded-default
            translate-x-full
            transition-transform
        "></div>
    </div>
</div>

@pushOnce('scripts')
    <script>
        editTextButtons = document.querySelectorAll('.edit-text-button-container');
        editTextInputs = document.querySelectorAll('edit-text-input');

        editTextButtons.forEach(editTextButton => {
            editTextButton.addEventListener('click', (e) => {
                const editTextInput = editTextButton.previousElementSibling;
                editTextInput.disabled = false;
                editTextInput.focus();
            });
        });

        editTextInputs.forEach(editTextInput => {
            editTextInput.addEventListener('focusout', (e) => {
                editTextInput.disabled = true;
            });
        });
    </script>
@endPushOnce