@pushOnce('styles')
    @vite('resources/css/components/image-input.css')
@endPushOnce

<div class="
    image-input
    flex flex-col 
">
    @if ($label)
        <label for="{{ $attributes->get('id') }}" class="self-center">{{ $label }}</label>
    @endif
        

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

    <input  
        {{
            $attributes->merge([
                'type' => 'file',
                'class' => 'avatar-input hidden'
            ])
        }}
    >
</div>

@pushOnce('scripts')
    @vite('resources/js/components/ImageInput.js')
@endPushOnce