@extends('layouts.app')


@section('content')
    <div class="flex flex-col justify-center">
        <div class="m-auto w-9/12 bg-white p-6 flex justify-between rounded-lg"> 
          <p class="text-lg mt-2 font-bold">Unfulfilled Orders</p>           
            <form action="{{ route('unfulfilled') }}" method="POST">
                @csrf
                <button type="submit" class="bg-gray-200 rounded-lg px-4 py-2">Refresh Orders</button>
            </form>
        </div>
        
        <div class="mx-auto m-4 w-9/12 bg-white p-6 rounded-lg shadow-lg bg-white flex flex-col">
        <div class="flex justify-between">
          <p class="text-lg mt-2 font-bold">Upload CSV</p> 
          <form action="{{ route('file-upload.post') }}" method="POST" enctype="multipart/form-data">
          @csrf
        
                  <input type="file" name="file" class="">
             
                  <button type="submit" class="px-4 py-2 bg-theme text-white rounded-lg">Upload</button>
          
         </form>
        </div>
          @if ($message = Session::get('success'))
          <div class="self-center mt-2">
              <strong>{{ $message }} </strong>
          </div>
          @endif 

          @if (count($errors) > 0)
          <div class="self-center mt-2">
              <strong>Whoops!</strong> There were some problems with your input.
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif 
        </div>


        <div class="mx-auto w-9/12 bg-white p-6 rounded-lg  shadow-lg bg-white">
            <form id="tracking-form" action="{{ route('fulfill') }}" method="post">
            @csrf
            <table class="table-fixed w-full text-center m-1">
                <thead>
                  <tr>
                    <th class="bg-purple-200 px-2  py-2 border">Order No.</th>
                    <th class="bg-purple-200 px-2 py-2 border">Tracking No.</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="border">
                        <td class="border">#{{ $order->order_number }}</td>
                        <td>
                            <label for="{{ $order->order_id }}" class="sr-only"></label>
                            <input name="{{ $order->order_id }}" id={{ $order->order_id}} class="border w-full bg-purple-50 focus:outline-none focus:ring-2 focus:ring-theme text-center @error("$order->order_id") border-red-500 @enderror" @if ($message = Session::get('file'))
                            @if (array_key_exists($order->order_number, $message))
                              value={{$message[$order->order_number]}}
                            @endif
                        @endif type="text">
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </form>
            @if ($orders->count() === 0)
              <p class="text-center p-4">No orders to show</p>
                  
            @endif
            {{$orders->links()}}
              <div class="flex justify-around mt-4">
                  <div></div>
                  <button onclick="return confirm('Please confirm you would like to fulfill these orders');" class="px-4 py-3 bg-theme text-white rounded-lg"type="submit" form="tracking-form">Fulfill Orders</button>
                    <form action="{{ route('orders.remove')}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Are you sure you want to remove all unfulfilled orders?');" type="submit">
                        <svg class="w-6 m-2"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </form>
             </div>
              
        </div>
   
    </div>
@endsection