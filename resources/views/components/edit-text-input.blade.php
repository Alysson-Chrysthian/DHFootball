<div class="flex flex-col {{ $attributes->get('class') }}">
    @error($attributes->get('wire:model.blur'))
        <span class="error">{{ $message }}</span>
    @enderror

    @if ($label)
        <label for="{{ $attributes->get('id') }}">{{ $label }}</label>
    @endif    
    
    <div class="
        edit-input-text-container
        flex items-center 
        relative
    ">
        <input
            {{
                $attributes->merge([
                    'type' => 'text',
                    'class' => '
                        edit-text-input
                        p-small
                        rounded-default
                        shadow-default
                        outline-none
                        bg-light text-dark
                        placeholder:text-dark
                        w-full
                    '
                ])
            }}
            @disabled(true)
        />
        <button
            type="button"
            class="
                edit-text-input-button
                w-8 h-8
                absolute right-2
                cursor-pointer      
            "
        >
            <x-ri-edit-line class="
                edit-text-input-icon
                hover:bg-secundary
                rounded-default
                p-tiny    
                hover:fill-light      
            " />
        </button>
    </div>
</div>

@pushOnce('scripts')
    <script>
        editIcons = document.querySelectorAll('.edit-text-input-icon');
        editTextInputs = document.querySelectorAll('.edit-text-input');

        editTextInputs.forEach(editTextInput => {        
            editTextInput.addEventListener('blur', (e) => {
                e.target.disabled = true;
            });
        });

        editIcons.forEach(editIcon => {
            editIcon.addEventListener('click', (e) => {
                let editTextInputContainer = e.target;

                do {
                    editTextInputContainer = editTextInputContainer.parentElement;
                } while (!editTextInputContainer.classList.contains('edit-input-text-container'))

                const editTextInput = editTextInputContainer.querySelector('.edit-text-input');

                console.log(e.target);
                console.log(editTextInput);

                editTextInput.disabled = false;
                editTextInput.focus();
            });
        });
    </script>
@endPushOnce