<div class="p-10 overflow-x-auto w-auto h-screen">
    {{-- header --}}
    <div class='sticky'>
        <h1 class='text-xl font-bold text-center'>Shuffle the deck</h1>

        <div class='py-3 items-center flex flex-col gap-2'>
          <h4>How many people wants to play?</h4>
          @if ($error)
                <div class="text-red-500 mt-2 italic text-sm">{{ $error }}</div>
            @endif
          <div class='flex gap-2'>
                <div>
                  <input type="number" step={1} wire:model='peopleCount' name='people' class='mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @if($error) text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 @endif"' />
                </div>
                <button class='bg-blue-200 rounded-lg px-2' wire:click="distributeCardss">Submit</button>

          </div>
        </div>
    </div>
    
    {{-- card distributed --}}
    @if (!empty($distribution))
        <div class='flex flex-col gap-2'>
            @foreach ($distribution as $player => $card)
                <div>
                    <h4 class='font-bold'>Player {{$player + 1}}</h4>
                    <div class='flex overflow-scroll gap-1 py-2 px-3'>
                        @foreach ($card as $item)
                            <div class='h-20 p-2 outline outline-solid block'>
                            <p class='text-center truncate'>{{$item}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    @endif
    
    {{-- card distributed --}}
    @if (!empty($results))
        <div class="mt-4">
            @foreach ($results as $line)
                <div>{{ $line }}</div>
            @endforeach
        </div>
    @endif
</div>