@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="min-w-1/2 bg-white p-6 rounded-lg mt-8">
            <form action="{{ route('password.reset', ['token' => $token]) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email"
                    id="email" placeholder="Your email"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">   

                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}<div>
                @enderror              
                </div>
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Choose a password"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="{{ old('password') }}">   
                    
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}<div>
                @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password again</label>
                    <input type="password" name="password_confirmation" id="password" placeholder="Repeat your password"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="{{ old('password_confirmation') }}">   
                    
                    @error('password_confirmation')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}<div>
                @enderror
                </div>
                <input type="hidden" name="token" value="{{$token}}">
                <div>
                    <button type="submit" class="w-full bg-theme rounded font-medium px-4 py-3 text-white ">Reset password</button>
                </div>
            </form>
        </div>
    </div>
@endsection