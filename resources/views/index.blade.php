<x-app-layout>
    <div class="filters flex space-x-6">
        <div class="w-1/3">
            <select name="category" id="category" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="Category One">Category One</option>
                <option value="Category Two">Category Two</option>
            </select>
        </div>
        <div class="w-1/3">
            <select name="other_filters" id="other_filters" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="Category One">Filter One</option>
                <option value="Category Two">Filter Two</option>
            </select>
        </div>
        <div class="w-2/3 relative">
            <input type="search" placeholder="Find an idea" class="w-full rounded-xl bg-white px-4 py-2 pl-8 border-none placeholder-gray-900"/>
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="ideas-containers space-y-6 my-6">
        <div class="idea-container bg-white rounded-xl flex hover:shadow-card transition duration-150 ease-in cursor-pointer">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>
                <div class="mt-8">
                    <button class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl px-4 py-3 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in">Vote</button>
                </div>
            </div>
            <div class="px-2 py-6 flex-none">
                <a href="#" target="_blank">
                    <img src="https://source.unsplash.com/200x200/?face&grop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-4 py-5">
                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">A Random Title Here!!</a>
                </h4>
                <div class="text-gray-600 mt-3 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, iste similique. Aperiam dolor libero recusandae. Alias architecto corporis doloremque eum excepturi itaque laboriosam nesciunt perspiciatis praesentium ratione! Consequatur eius minus neque? Accusamus asperiores aut autem consequatur culpa cupiditate deleniti dignissimos dolore, doloremque dolores earum enim error ex excepturi fugiat fugit laboriosam, maiores molestias mollitia nam odit perferendis possimus provident quod ratione similique sint soluta, suscipit temporibus totam vel voluptatem voluptatibus voluptatum? Animi architecto, asperiores autem dolor ea enim, esse explicabo incidunt inventore laborum magnam maxime minima modi mollitia nesciunt obcaecati omnis placeat quaerat quas quos repellat sapiente similique, veritatis voluptate?</div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div>10 hours ago</div>
                        <div>&bull;</div>
                        <div>Category 1</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">3 Comments</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
                        <button class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in px-3 text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>

                            <ul class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                <li>
                                    <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Mark as Span</a>
                                    <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Delete Post</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="idea-container bg-white rounded-xl flex hover:shadow-card transition duration-150 ease-in cursor-pointer">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>
                <div class="mt-8">
                    <button class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl px-4 py-3 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in">Vote</button>
                </div>
            </div>
            <div class="px-2 py-6 flex-none">
                <a href="#" target="_blank">
                    <img src="https://source.unsplash.com/200x200/?face&grop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-4 py-5">
                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">A Random Title Here!!</a>
                </h4>
                <div class="text-gray-600 mt-3 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, iste similique. Aperiam dolor libero recusandae. Alias architecto corporis doloremque eum excepturi itaque laboriosam nesciunt perspiciatis praesentium ratione! Consequatur eius minus neque? Accusamus asperiores aut autem consequatur culpa cupiditate deleniti dignissimos dolore, doloremque dolores earum enim error ex excepturi fugiat fugit laboriosam, maiores molestias mollitia nam odit perferendis possimus provident quod ratione similique sint soluta, suscipit temporibus totam vel voluptatem voluptatibus voluptatum? Animi architecto, asperiores autem dolor ea enim, esse explicabo incidunt inventore laborum magnam maxime minima modi mollitia nesciunt obcaecati omnis placeat quaerat quas quos repellat sapiente similique, veritatis voluptate?</div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div>10 hours ago</div>
                        <div>&bull;</div>
                        <div>Category 1</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">3 Comments</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
                        <button class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in px-3 text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>

                            <ul class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                <li>
                                    <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Mark as Span</a>
                                    <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Delete Post</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
