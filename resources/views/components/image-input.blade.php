@pushOnce('styles')
    @vite('resources/css/components/image-input.css')
@endPushOnce

<div class="
    image-input
    flex flex-col 
    justify-center items-center
    {{ $attributes->get('class') }}
">   

    @error($attributes->get('wire:model.live') ?? $attributes->get('wire:model.blur'))
        <span class="error">{{ $message }}</span>
    @enderror

    <label for="{{ $attributes->get('id') ?? 'image-input' }}">
        @if ($source)
            <figure class="
                avatar-icon
                hover:brightness-40
                cursor-pointer
            ">
                <img src="{{ $source }}" />
            </figure>
        @else
            <x-iconsax-bul-profile-circle
                class="
                    avatar-icon
                    fill-light stroke-secundary
                    hover:brightness-40
                    cursor-pointer
                "
            />
        @endif
    </label>

    <input  
        {{
            $attributes->merge([
                'type' => 'file',
                'class' => 'avatar-input hidden',
                'id' => $attributes->get('id') ?? 'image-input'    
            ])
        }}
    >
</div>
