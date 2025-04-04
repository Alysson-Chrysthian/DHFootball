@pushOnce('styles')
    @vite('resources/css/pages/chat.css')
@endPushOnce

<div
    class="
        chat
        flex flex-col
        p-very-large
    "
    data-contact_id="{{ $contactId }}"
>

    <div class="
        grow overflow-auto
    ">
        <p class="text-center text-shadow">Envie uma mensagem para iniciar uma conversar</p>
    </div>

    <div>
        <form 
            class="
                flex items-end
                gap-small
                bg-light
                w-full
            "
            wire:submit.prevent="sendMessage"    
        >
            <x-text-input
                wire:model="message"
                :showerror="false"
                class="w-full"
                placeholder="Mensagem..."
            />
            <x-send-button 
                type="submit"
            />
        </form>
    </div>

</div>

@pushOnce('scripts')
    @vite('resources/js/pages/chat.js')
@endPushOnce