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
    data-role="{{ $role }}"
>

    <div class="
        messages-display
        grow overflow-auto
    ">
        @if ($chats->isEmpty())
            <p class="text-center text-shadow" id="empty-chat">Envie uma mensagem para iniciar uma conversar</p>
        @else
            @foreach ($chats as $chat)
                <div 
                    class="
                        message
                        @if ($chat->role == $role)
                            sent
                        @else
                            recieved
                        @endif
                    ">
                    <p>{{ $chat->message }}</p>
                    <p>{{ $chat->created_at->format('d/m/Y - H:i') }}</p>
                </div>
            @endforeach    
        @endif
    </div>

    <div>
        <form 
            class="
                send-message-form
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