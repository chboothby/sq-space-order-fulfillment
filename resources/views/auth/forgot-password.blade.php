@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen -mt-6">
        <div class="min-w-1/2 bg-white p-6 rounded-lg mt-8">
           
            <form action="{{ route('password.forgot') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="sr-only">email</label>
                    <input type="text" name="email" 
                    id="email" placeholder="Email"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">  

                    @error('email')
                    <div class="text-red-500 m-2 text-sm">
                        {{ $message }}<div>
                @enderror               
                </div>
                             
                <div>
                    <button type="submit" class="w-full  bg-theme rounded font-medium px-4 py-3 mt-2 -mb-4 text-white">Send reset link</button>
                </div>
            </form>
            @if ($message = Session::get('status'))
            <p class="font-bold text-red-600 text-center mt-4">{{ $message }} </p>
           @endif 
        </div>
    </div>
@endsection