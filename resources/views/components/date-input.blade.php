<div>
    @error($attributes->get('wire:model.live'))
        <span class="error">{{ $message }}</span>
    @enderror

    @if ($label)
        <label for="{{ $attributes->get('id') }}">{{ $label }}</label>
    @endif

    <input 
        {{
            $attributes->merge([
                'type' => 'date',
                'class' => '
                    p-small
                    rounded-default
                    shadow-default
                    w-full
                    bg-light text-dark
                '
            ])
        }}
    />
</div>