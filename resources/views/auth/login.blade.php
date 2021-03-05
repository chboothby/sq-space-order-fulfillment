@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="w-4/12 bg-white p-6 rounded-lg mt-8">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" 
                    id="username" placeholder="Username"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}">  

                    @error('username')
                    <div class="text-red-500 nt-2 text-sm">
                        {{ $message }}<div>
                @enderror               
                </div>
               
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="{{ old('password') }}">   
                    
                    @error('password')
                    <div class="text-red-500 nt-2 text-sm">
                        {{ $message }}<div>
                @enderror
                </div>
                
                <div>
                    <button type="submit" class="w-full bg-theme rounded font-medium px-4 py-3 text-white ">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection