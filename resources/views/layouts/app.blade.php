<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="shortcut icon" href="/favicon.ico" >
    <title>Grow Wild Order Fulfillment</title>

</head>
<body class="bg-theme">
    @auth
        <nav class="p-4 bg-white mb-5 mx-auto">
            <p id="hamburgerbtn" class="sm:hidden hover:bg-theme w-10 hover:text-white hover:opacity-30 rounded-lg m-0">
                <svg class="w-10 p-2 text-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>
            </p>
            <ul class="hidden justify-around font-bold sm:text-xl sm:flex sm:flex-row" id="menu">
                <li><a class="hover:bg-theme hover:text-white sm:p-3 hover:opacity-30 rounded-lg @if (Route::currentRouteName() === 'unfulfilled') sm:bg-gray-400 @endif"href="{{route('unfulfilled')}}">Unfulfilled</a></li>
                <li><a class="hover:bg-theme hover:text-white sm:p-3 hover:opacity-30 rounded-lg @if (Route::currentRouteName() === 'fulfilled') sm:bg-gray-400 @endif"href="{{route('fulfilled')}}">Fulfilled</a></li>            
                <li><a class="hover:bg-theme hover:text-white sm:p-3 hover:opacity-30 rounded-lg @if (Route::currentRouteName() === 'courier') sm:bg-gray-400 @endif"href="{{route('courier')}}">Create CSV</a></li>            
                <form class="flex hover:bg-theme hover:text-white  hover:opacity-30 rounded-lg sm:-m-3 sm:p-3" action="{{route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="font-bold" type="submit">Logout
                    </button>
                </form> 
            </ul>
        </nav>
    @endauth
    @yield('content')
  
    <script>
        const hamburger = document.getElementById('hamburgerbtn');
        const menu = document.getElementById('menu');

        hamburger.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>