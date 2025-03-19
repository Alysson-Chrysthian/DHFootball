<div>
    
    <div class="
        flex items-center justify-evenly
        gap-very-large p-very-large
        w-full
    ">
        <x-select
            class="w-full"
            placeholder="Todas as posições"
            :dark="true"
        >
            @foreach ($positions as $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
            @endforeach
        </x-select>

        <x-select 
            class="w-full"
            placeholder="Todas as idades"
            :dark="true"
        >
            @foreach ($ages as $age)
                <option value="{{ $age->value }}">{{ $age->text() }}</option>
            @endforeach
        </x-select>
    </div>

</div>
