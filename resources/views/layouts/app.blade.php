<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laracasts Voting</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-background antialiased text-gray-900 text-sm">
        <header class="flex items-center justify-between px-8 py-4">
            <a href="#">
                <img src="{{ asset('img/logo.svg') }}" alt="Laracasts Logo">
            </a>
            <div class="flex items-center">
                @if (Route::has('login'))
                    <div class="px-6 py-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
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

        <main class="container mx-auto flex max-w-custom">
            <div class="w-70 mr-5">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium animi eos nihil quos suscipit? Ad cupiditate odit quaerat repellendus suscipit! Amet, blanditiis delectus dolores error eveniet, ex fuga hic iure minus necessitatibus obcaecati odit omnis optio placeat quaerat quas quidem reiciendis repellat reprehenderit saepe sint sit unde ut veniam voluptas!
            </div>
            <div class="w-175">
                <nav class="flex item-center justify-between text-xs">
                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                        <li><a href="" class="border-b-4 pb-3 border-blue">All Ideas (87)</a></li>
                        <li><a href="" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Considering (6)</a></li>
                        <li><a href="" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">In Progress (6)</a></li>
                    </ul>
                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                        <li><a href="" class="border-b-4 pb-3 border-blue">Implemented (10)</a></li>
                        <li><a href="" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Closed (6)</a></li>
                    </ul>
                </nav>

                <div class="mt-8">
                    {{ $slot  }}
                </div>
            </div>
        </main>
    </body>
</html>
