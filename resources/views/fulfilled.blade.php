@extends('layouts.app')


@section('content')
    <div class="flex flex-col justify-center">
        <div class="m-auto w-9/12 bg-white p-6 flex justify-between rounded-lg">
            <p class="text-lg mt-2 font-bold">Fulfilled Orders</p>  
        </div>

        <div class="h-96 mx-auto m-4 w-9/12 bg-white p-6 rounded-lg  shadow-lg bg-white  overflow-x-scroll">
            <table class="table-auto w-full text-center m-1">
                <thead>
                  <tr>
                    <th class="bg-purple-200 px-8 text-left py-4 border">Order No.</th>
                    <th class="bg-purple-200 px-8 py-4 border">Product</th>
                    <th class="bg-purple-200 px-8 py-4 border">Order Date</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="border">
                        <td class="border">#{{ $order->order_number }}</td>
                        <td class="border">{{ $order->product }}</td>
                        <td class="border">{{ \Carbon\Carbon::parse( $order->order_date )->toDateString() }}</td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              @if ($orders->count() === 0)
              <p class="text-center p-4">No orders to show</p>
                  
              @endif
            {{$orders->links()}}
                  
        </div>
   
    </div>
@endsection