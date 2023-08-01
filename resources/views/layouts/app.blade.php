<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laracasts Voting</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-background antialiased text-gray-900 text-sm">
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="{{route('idea.index')}}">
                <img src="{{ asset('img/logo.svg') }}" alt="Laracasts Logo">
            </a>
            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                    <div class="px-6 py-4">
                        @auth
                            <div class="flex items-center space-x-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                <div
                                    x-data="{ isOpen: false }"
                                    class="relative"
                                    >
                                    <button
                                        @click="isOpen = !isOpen">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                        </svg>
                                        <span class="absolute bg-red text-white text-xxs w-6 h-6 rounded rounded-full flex justify-center items-center border-2 -top-1 -right-1">8</span>
                                    </button>
                                    <ul
                                        x-cloak
                                        x-show="isOpen"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-90"
                                        @click.away="isOpen = false"
                                        @keydown.escape.window="isOpen = false"
                                        class="absolute w-96 text-left bg-white shadow-dialog rounded-xl z-10 -right-28 md:-right-12 text-xs max-h-128 overflow-y-auto text-gray-700">
                                        <li>
                                           <a href="#"
                                           class="flex hover:bg-gray-100 transition duration-150 ease-in px-5 py-3">
                                               <img src="https://www.gravatar.com/avatar/dadasdasdas" class="rounded-xl w-10 h-10" alt="Avatar">
                                               <div class="ml-4">
                                                   <div>
                                                       <span class="font-semibold">detorresrc</span>
                                                       commented on
                                                       <span class="font-semibold">This is my idea</span> :
                                                       <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eaque excepturi odit, perspiciatis quibusdam similique voluptate? Deleniti earum fuga nulla.</span>
                                                   </div>
                                                   <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                               </div>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="flex hover:bg-gray-100 transition duration-150 ease-in px-5 py-3">
                                                <img src="https://www.gravatar.com/avatar/dadasdasdas" class="rounded-xl w-10 h-10" alt="Avatar">
                                                <div class="ml-4">
                                                    <div class="line-clamp-6">
                                                        <span class="font-semibold">detorresrc</span>
                                                        commented on
                                                        <span class="font-semibold">This is my idea</span> :
                                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias aliquid aperiam architecto aspernatur beatae commodi eligendi et ex expedita, facere fuga hic id laborum minima mollitia nam nesciunt nisi, officia officiis perferendis quaerat quas quibusdam recusandae repudiandae sequi sit sunt tenetur velit voluptas! Aliquam debitis deleniti deserunt eos exercitationem, quibusdam? A adipisci aut corporis culpa cupiditate, delectus deleniti dignissimos dolore, dolores ducimus est in iure minima molestias nam placeat quae quasi quo quod repellat repudiandae sapiente sequi similique suscipit velit voluptas voluptates. Accusamus distinctio impedit ipsa magni nisi officiis perspiciatis quos tenetur voluptas, voluptatum. Facilis laboriosam nesciunt perspiciatis voluptatibus!</span>
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="border-t border-gray-300 text-center">
                                            <button
                                               class="w-full font-semibold hover:bg-gray-100 transition duration-150 ease-in px-5 py-4">Mark all as read</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

                <a href="#">
                    <img src="https://www.gravatar.com/avatar/0000000000000000000000000?d=mp" class="w-10 h-10 rounded-full"/>
                </a>
            </div>
        </header>

        <main class="container mx-auto flex max-w-custom flex-col md:flex-row">
            <div class="w-70 md:mr-5 mx-auto md:mx-0">
                <div
                    class="bg-white border-2 border-blue rounded-xl mt-16 md:sticky md:top-8">
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Add an idea</h3>
                        <p class="text-xs mt-4">
                        @auth
                            Let us know what you would like and we'll take a look over!
                        @else
                            Please login to create an idea.
                        @endauth
                        </p>
                    </div>

                    @auth
                    <livewire:create-idea/>
                    @else
                    <div class="my-6 space-y-3 text-center">
                        <a
                            href="{{ route('login') }}"
                            class="inline-block justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                            Login
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="inline-block justify-center w-1/2 h-11 text-xs bg-gray-200 text-black-50 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                            Sign Up
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
            <div class="w-full md:w-175 px-2 md:px-0">
                @livewire('status-filters')

                <div class="mt-8">
                    {{ $slot  }}
                </div>
            </div>
        </main>

        @if(session('success_message'))
            <x-success-notification
                :redirect="true"
                message-to-display="{{ (session('success_message')) }}"/>
        @endif

        @stack('modals')

        @livewireScripts
    </body>
</html>
