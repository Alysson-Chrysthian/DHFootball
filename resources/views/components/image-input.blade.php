@pushOnce('styles')
    @vite('resources/css/components/image-input.css')
@endPushOnce

<div class="
    image-input
    flex flex-col 
">   

    <label for="{{ $attributes->get('id') }}">
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
                'class' => 'avatar-input hidden'
            ])
        }}
    >
</div>
