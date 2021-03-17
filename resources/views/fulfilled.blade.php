@extends('layouts.app')


@section('content')
    <div class="flex flex-col justify-center">
        <div class="m-auto w-11/12 sm:w-9/12 bg-white p-6 flex justify-between rounded-lg">
            <p class="text-lg font-bold">Fulfilled Orders</p>
        </div>

        <div class="mx-auto m-4 w-11/12 sm:w-9/12 bg-white p-6 rounded-lg  shadow-lg bg-white">
            <table class="table-auto w-full text-center m-1">
                <thead>
                    <tr>
                        <th class="bg-purple-200 px-4 text-left py-3 border">Order No.</th>
                        <th class="bg-purple-200 px-3 py-3 border">Product</th>
                        <th class="bg-purple-200 px-3 py-4 border">Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border">
                            <td class="border">#{{ $order->order_number }}</td>
                            <td class="border">{{ $order->product }}</td>
                            <td class="border">{{ \Carbon\Carbon::parse($order->order_date)->toDateString() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($orders->count() === 0)
                <p class="text-center p-4">No orders to show</p>

            @endif
            {{ $orders->links() }}

        </div>

    </div>
@endsection
