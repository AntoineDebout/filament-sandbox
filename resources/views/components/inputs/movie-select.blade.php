<div x-data="{ open: false }">
    <label class="block text-sm font-medium text-gray-700">
        {{ is_string($label) ? $label : (is_object($label) && method_exists($label, '__toString') ? $label->__toString() : '') }}
    </label>
    <div class="relative mt-1 text-black">
        <input type="text" placeholder="Rechercher un film..." x-on:focus="open = true"
               class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md" />

        <div x-show="open" class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md">
            <ul class="max-h-60 overflow-auto">
                @foreach ($options as $movieId => $movie)
                    <li class="flex items-center p-2 cursor-pointer hover:bg-gray-100" wire:click="setState('{{ $movieId }}')">
                        <img src="{{ $movie['poster'] }}" alt="Poster" class="w-8 h-12 mr-3 rounded-md">
                        <span>{{ $movie['title'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>