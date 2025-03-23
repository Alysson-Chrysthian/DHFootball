<div class="flex flex-col {{ $attributes->get('class') }}">
    @error($attributes->get('wire:model.live') ?? $attributes->get('wire:model.blur'))
        <span class="error">{{ $message }}</span>
    @enderror

    @if ($label)
        <label for="{{ $attributes->get('id') }}">{{ $label }}</label>
    @endif    
    
    <div class="
        relative
        flex items-center
        w-full    
    ">
        <input
            {{
                $attributes->merge([
                    'type' => 'text',
                    'class' => '
                        p-small
                        rounded-default
                        shadow-default
                        outline-none
                        bg-light text-dark
                        placeholder:text-dark
                        flex-grow
                    '
                ])
            }}
        />
        <x-ri-search-line
            class="
                w-6 h-6
                absolute
                right-small
            "
        />
    </div>
</div>