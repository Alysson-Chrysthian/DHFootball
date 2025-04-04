<div class="flex flex-col {{ $attributes->get('class') }}">
    @if ($showerror)
        @error($attributes->get('wire:model.live') ?? $attributes->get('wire:model.blur'))
            <span class="error">{{ $message }}</span>
        @enderror
    @endif

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