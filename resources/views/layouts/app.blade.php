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
    <nav class="p-6 bg-white mb-5">
        <ul class="flex justify-around font-bold text-xl">
            <li><a class="hover:bg-theme hover:text-white p-2 hover:opacity-30 rounded-lg"href="{{route('unfulfilled')}}">Unfulfilled</a></li>
            <li><a class="hover:bg-theme hover:text-white p-2 hover:opacity-30 rounded-lg"href="{{route('fulfilled')}}">Fulfilled</a></li>            
            <form class="flex hover:bg-theme hover:text-white  hover:opacity-30 rounded-lg -m-2 p-2"action="{{route('logout') }}" method="POST" class="inline">
                @csrf
                <button class="font-bold" type="submit">Logout
                </button>
            </form>
        </ul>
       
   
    </nav>
    @endauth

    @yield('content')

</body>
</html>