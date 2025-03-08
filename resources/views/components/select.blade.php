<div class="flex flex-col {{ $attributes->get('class') }}">
    @error($attributes->get('wire:model.live'))
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
            ])
        }}
    >
        @if ($placeholder)
            <option>{{ $placeholder }}</option>
        @endif
        {{ $slot ?? '' }}
    </select>
</div>