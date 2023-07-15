<x-app-layout>
    <a href="/" class="flex items-center font-semibold hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="ml-2">All ideas</span>
    </a>

    <div class="idea-container bg-white rounded-xl flex cursor-pointer mt-4">
        <div class="px-4 py-6 flex-none">
            <a href="#" target="_blank">
                <img src="https://source.unsplash.com/200x200/?face&grop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="mx-4 py-5 w-full flex-1">
            <h4 class="text-xl font-semibold">
                <a href="#" class="hover:underline">A Random Title Here!!</a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, iste similique. Aperiam dolor libero recusandae. Alias architecto corporis doloremque eum excepturi itaque laboriosam nesciunt perspiciatis praesentium ratione! Consequatur eius minus neque? Accusamus asperiores aut autem consequatur culpa cupiditate deleniti dignissimos dolore, doloremque dolores earum enim error ex excepturi fugiat fugit laboriosam, maiores molestias mollitia nam odit perferendis possimus provident quod ratione similique sint soluta, suscipit temporibus totam vel voluptatem voluptatibus voluptatum? Animi architecto, asperiores autem dolor ea enim, esse explicabo incidunt inventore laborum magnam maxime minima modi mollitia nesciunt obcaecati omnis placeat quaerat quas quos repellat sapiente similique, veritatis voluptate?</div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="font-bold text-gray-900">detorresrc</div>
                    <div>&bull;</div>
                    <div>10 hours ago</div>
                    <div>&bull;</div>
                    <div>Category 1</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
                    <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3 text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>

                        <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                            <li>
                                <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Mark as Span</a>
                                <a href="#" class="block hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in">Delete Post</a>
                            </li>
                        </ul>
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- end idea-container -->

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex items-center space-x-4 ml-6">
            <button type="button"
                    class="flex items-center justify-center h-11 w-36 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                <span class="ml-1">Reply</span>
            </button>

            <button type="button"
                    class="flex items-center justify-center w-36 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in ">
                <span>Set Status</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        <div class="flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                <div class="text-xl leading-snug">12</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            <button type="button"
                    class="w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in uppercase">
                <span>Vote</span>
            </button>
        </div>
    </div> <!-- end buttons-container -->

    <div class="comments-container space-y-6 ml-22 relative pt-4 my-8 mt-1">
        <div class="comment-container bg-white rounded-xl flex cursor-pointer mt-4 relative">
            <div class="px-4 py-6 flex-none">
                <a href="#" target="_blank">
                    <img src="https://source.unsplash.com/200x200/?face&grop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-4 py-5 w-full flex-1">
                <div class="text-gray-600 mt-3 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, iste similique. Aperiam dolor libero recusandae. Alias architecto corporis doloremque eum excepturi itaque laboriosam nesciunt perspiciatis praesentium ratione! Consequatur eius minus neque? Accusamus asperiores aut autem consequatur culpa cupiditate deleniti dignissimos dolore, doloremque dolores earum enim error ex excepturi fugiat fugit laboriosam, maiores molestias mollitia nam odit perferendis possimus provident quod ratione similique sint soluta, suscipit temporibus totam vel voluptatem voluptatibus voluptatum? Animi architecto, asperiores autem dolor ea enim, esse explicabo incidunt inventore laborum magnam maxime minima modi mollitia nesciunt obcaecati omnis placeat quaerat quas quos repellat sapiente similique, veritatis voluptate?</div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-gray-900">detorresrc</div>
                        <div>10 hours ago</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3 text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div> <!-- comment-container -->
        <div class="comment-container is-admin bg-white rounded-xl flex cursor-pointer mt-4 relative">
            <div class="px-4 py-6 flex-none">
                <div class="flex flex-col">
                    <a href="#" target="_blank">
                        <img src="https://source.unsplash.com/200x200/?face&grop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                    <div class="font-bold mt-1 text-xs text-center text-blue uppercase">ADMIN</div>
                </div>
            </div>
            <div class="mx-4 py-5 w-full flex-1">
                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">A Random Title Here!!</a>
                </h4>
                <div class="text-gray-600 mt-3 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, iste similique. Aperiam dolor libero recusandae. Alias architecto corporis doloremque eum excepturi itaque laboriosam nesciunt perspiciatis praesentium ratione! Consequatur eius minus neque? Accusamus asperiores aut autem consequatur culpa cupiditate deleniti dignissimos dolore, doloremque dolores earum enim error ex excepturi fugiat fugit laboriosam, maiores molestias mollitia nam odit perferendis possimus provident quod ratione similique sint soluta, suscipit temporibus totam vel voluptatem voluptatibus voluptatum? Animi architecto, asperiores autem dolor ea enim, esse explicabo incidunt inventore laborum magnam maxime minima modi mollitia nesciunt obcaecati omnis placeat quaerat quas quos repellat sapiente similique, veritatis voluptate?</div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-blue">detorresrc</div>
                        <div>10 hours ago</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3 text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div> <!-- comment-container -->
        <div class="comment-container bg-white rounded-xl flex cursor-pointer mt-4 relative">
            <div class="px-4 py-6 flex-none">
                <a href="#" target="_blank">
                    <img src="https://source.unsplash.com/200x200/?face&grop=face&v=4" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-4 py-5 w-full flex-1">
                <div class="text-gray-600 mt-3 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, iste similique. Aperiam dolor libero recusandae. Alias architecto corporis doloremque eum excepturi itaque laboriosam nesciunt perspiciatis praesentium ratione! Consequatur eius minus neque? Accusamus asperiores aut autem consequatur culpa cupiditate deleniti dignissimos dolore, doloremque dolores earum enim error ex excepturi fugiat fugit laboriosam, maiores molestias mollitia nam odit perferendis possimus provident quod ratione similique sint soluta, suscipit temporibus totam vel voluptatem voluptatibus voluptatum? Animi architecto, asperiores autem dolor ea enim, esse explicabo incidunt inventore laborum magnam maxime minima modi mollitia nesciunt obcaecati omnis placeat quaerat quas quos repellat sapiente similique, veritatis voluptate?</div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-gray-900">detorresrc</div>
                        <div>10 hours ago</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3 text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div> <!-- comment-container -->
    </div> <!-- end comments-container -->

</x-app-layout>
