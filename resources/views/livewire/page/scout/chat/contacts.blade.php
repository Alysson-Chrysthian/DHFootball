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
                wire:model.live="positionFilter"
            >
                <option value="0">Todas as posições</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </x-select>
            
            <x-select
                class="w-full"
                dark
                wire:model.live="ageFilter"
            >
                <option value="0">Todas as idades</option>
                @foreach ($ages as $age)
                    <option value="{{ $age->value }}">{{ $age->text() }}</option>
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
                    <x-profile :user="$contact->player" />
                    <div>
                        <p
                            class="
                                flex items-center gap-normal
                            "
                        >{{ $contact->player->name }} <span class="circle"></span> {{ $contact->player->getAge() }}</p>
                        <p class="text-shadow">
                            @if ($contact->getLastMessageSent())
                                {{ $contact->getLastMessageSent()->getFormatedMessage() }}
                            @else
                                Nenhuma mensage
                            @endif
                        </p>
                    </div>
                </div>
                <div class="justify-self-end">
                    <x-select
                        wire:model.live="selectedStatus.{{ $contact->id }}"
                        wire:change="changeStatus({{ $contact }})"
                    >
                        @foreach ($status as $statu)
                            <option value="{{ $statu->value }}">{{ $statu->text() }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
        @endforeach
    </div>

</div>
