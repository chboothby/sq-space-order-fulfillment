@extends('layouts.app')


@section('content')
    <div class="flex flex-col justify-center">
        <div class="m-auto w-9/12 bg-white p-6 flex justify-between rounded-lg">
            <p class="mt-2 text-xl font-bold">Unfulfilled Orders</p>
            <form action="{{ route('home') }}" method="POST">
                @csrf
                <button type="submit" class="bg-gray-200 rounded-lg px-4 py-2">Refresh Orders</button>
            </form>
              
        </div>

        <div class="mx-auto m-4 w-9/12 bg-white p-6 rounded-lg  shadow-lg bg-white">
            <form id="tracking-form" action="{{ route('fulfill') }}" method="post">
            @csrf
            <table class="table-auto w-full text-center ">
                <thead>
                  <tr>
                    <th class="bg-purple-200 px-8 text-left py-4 border">Order No.</th>
                    <th class="bg-purple-200 px-8 py-4 border">Tracking No.</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="border">
                        <td class="border">#{{ $order->order_number }}</td>
                        <td>
                            <label for="{{ $order->order_id }}" class="sr-only"></label>
                            <input name="{{ $order->order_id }}" id={{ $order->order_id}} class="border w-full bg-purple-50" type="text">
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </form>
              <div class="flex justify-center mt-4">
                  <button class="px-4 py-3 bg-theme text-white rounded-lg"type="submit" form="tracking-form">Fulfill Orders</button>
             </div>
              
        </div>
   
    </div>
@endsection