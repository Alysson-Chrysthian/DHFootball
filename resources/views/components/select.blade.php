<div class="flex flex-col {{ $attributes->get('class') }}">
    @error($attributes->get('wire:model.live') ?? $attributes->get('wire:model.blur'))
        <span class="error">{{ $message }}</span> 
    @enderror

    @if ($label)
        <label for="{{ $attributes->get('id') }}">{{ $label }}</label>
    @endif

    <select 
        {{
            $attributes->merge([
                'class' => '
                    p-small
                    rounded-default
                    shadow-default
                    bg-light text-dark
                    outline-none
                    w-full
                ' 
                . ($dark ? 'bg-secundary text-light' : '')
            ])
        }}
    >
        @if ($placeholder)
            <option>{{ $placeholder }}</option>
        @endif
        {{ $slot ?? '' }}
    </select>
</div>