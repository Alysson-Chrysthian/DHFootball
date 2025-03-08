<div class="flex flex-col {{ $attributes->get('class') }}">
    @error($attributes->get('wire:model.live'))
        <span class="error">{{ $message }}</span>
    @enderror

    @if ($label)
        <label for="{{ $attributes->get('id') }}">{{ $label }}</label>
    @endif    
    
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
                '
            ])
        }} 
    />
</div>