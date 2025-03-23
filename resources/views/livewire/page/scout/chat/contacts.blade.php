<div>

    <div class="
        flex flex-col
        gap-very-large p-very-large
    ">
        <x-search-input
            placeholder="Pesquisa..."
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

</div>
