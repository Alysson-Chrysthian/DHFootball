<div>
    <button 
        {{ 
            $attributes->merge([
                'type' => $type ?? 'button',
                'class' => '
                    flex itens-center justify-center
                    bg-primary text-light 
                    p-small
                    rounded-default
                    shadow-default
                    w-full
                    cursor-pointer
                    hover:brightness-80
                '
            ]) 
        }}
    >
        <span 
            @if ($attributes->get('wire:target')) 
                wire:loading.remove  
                wire:target="{{ $attributes->get('wire:target') }}"    
            @endif
        >
            {{ $slot ?? "" }}
        </span>

        @if ($attributes->get('wire:target'))
            <x-css-spinner 
                class="animate-spin"
                wire:target="{{ $attributes->get('wire:target') }}"
                wire:loading 
            />
        @endif
    </button>
</div>