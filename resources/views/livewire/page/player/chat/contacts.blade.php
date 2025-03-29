<div>

    <div class="
        flex flex-col
        gap-very-large p-very-large
    ">
        <x-search-input
            placeholder="Pesquisa..."
            wire:model.live="search"
        />
        
        <div class="
            flex items-center
            w-full gap-very-large
        ">   
            <x-select
                class="w-full"
                dark
                wire:model.live="clubFilter"
            >
                <option value="0">Todas os clubes</option>
                @foreach ($clubs as $club)
                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                @endforeach
            </x-select>
        </div>
    </div>

    <div class="
        flex flex-col
    ">
        @if ($contacts->isEmpty())
            <p class="text-center text-shadow">Nenhum contato encontrado</p>
        @endif

        @foreach ($contacts as $contact)
            <div class="
                border-t-1 border-dark
                flex items-center justify-between
                gap-normal p-very-large
                bg-light
                hover:brightness-80 
                cursor-pointer
                w-full
            ">
                <div class="
                    flex items-center
                    gap-normal           
                ">
                    <x-profile :user="$contact->scout" />
                    <div>
                        <p
                            class="
                                flex items-center gap-normal
                            "
                        >{{ $contact->scout->name }} <span class="circle"></span> <img src="/local/{{ $contact->scout->getClubIcon() }}" class="club_icon"></p>
                        <p class="text-shadow">
                            @if ($contact->getLastMessageSent())
                                {{ $contact->getLastMessageSent()->getFormatedMessage() }}
                            @else
                                Nenhuma mensage
                            @endif
                        </p>
                    </div>
                </div>

                <div 
                    class="
                        shadow-default p-small rounded-default
                        hover:bg-secundary 
                        hover:text-light
                    "
                    wire:click="deleteContact({{ $contact->id }})"
                    wire:key="{{ $contact->id }}"
                >
                    Excluir
                </div>
            </div>
        @endforeach
    </div>

</div>
