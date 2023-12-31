<div>
    <div class="filters flex flex-col md:flex-row md:space-x-6 space-y-3 md:space-y-0">
        <div class="w-full md:w-1/3">
            <select wire:model="category" name="category" id="category" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="All Categories">All Categories</option>
                @foreach($categories as $category)
                <option value="{{$category->name}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select wire:model="filter" name="other_filters" id="other_filters" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="">No Filter</option>
                <option value="Top Voted">Top Voted</option>
                <option value="My Ideas">My Ideas</option>
                @admin
                <option value="Spam Ideas">Spam Ideas</option>
                <option value="Spam Comments">Spam Comments</option>
                @endadmin
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <input wire:model="search" type="search" placeholder="Find an idea" class="w-full rounded-xl bg-white px-4 py-2 pl-8 border-none placeholder-gray-900"/>
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="ideas-containers space-y-6 my-6">
        @forelse($ideas as $idea)
            <livewire:idea-index :key="$idea->id" :idea="$idea"/>
        @empty
            <div class="mx-auto w-70 mt-12 ">
                <img src="{{ asset('img/no-ideas.svg') }}" alt="No Idea" class="mx-auto" style="mix-blend-mode: luminosity;">
                <div class="text-gray-400 text-center font-bold mt-6">No ideas were found...</div>
            </div>
        @endforelse
    </div>

    <div class="my-8">
        {{ $ideas->links()  }}
    </div>
</div>
