@extends('layouts.app')
@php
 $table_headings = ['customer_ref1', 'delivery_contact_name', 'delivery_addressline1', 'delivery_addressline2', 'delivery_post_code', 'delivery_instructions', 'delivery_contact_no', 'notification_sms', 'notficication_email', 'number_of_parcels', 'total_weight', 'shipment_date', 'Delivery Service code']  
@endphp

@section('content')
  <div class="flex flex-col justify-center">
    <div class="m-auto w-11/12 sm:w-9/12 bg-white p-6 flex justify-between rounded-lg">
      <p class="text-lg font-bold">Create CSV for Courier</p>  
    </div>

    <div class="mx-auto m-4 w-11/12 sm:w-9/12 bg-white p-6 rounded-lg  shadow-lg bg-white overflow-x-scroll">
      <form id="csv-form" action="{{ route('courier.make')}}" method="post" class="flex flex-col">
      @csrf
      <table class="table-auto w-full text-center m-1">
        <thead>
          <tr>
            @foreach ($table_headings as $heading)
              <th class="bg-purple-200 px-4 text-left py-3 border">{{ $heading }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr class="border">
                <td class="flex justify-around h-8 pt-4">
                  <label for="{{ $order->order_number }}" class="self-center">#{{$order->order_number}}</label>
                  <input name="{{ $order->order_number }}" id={{ $order->order_number}} type="checkbox" checked class="self-center">
                </td>
                <td class="border">{{ $order->delivery_contact_name }}</td>
                <td class="border">{{ $order->delivery_addressline1 }}</td>
                <td class="border">{{ $order->delivery_addressline2 }}</td>
                <td class="border">{{ $order->delivery_post_code }}</td>
                <td class="border">DO NOT LEAVE</td>
                <td class="border">{{ $order->notification_sms }}</td>
                <td class="border">{{ $order->notification_sms }}</td>
                <td class="border">{{ $order->notification_email }}</td>
                <td class="border">{{ ceil($order->weight / 3) }}</td>
                <td class="border">{{ $order->weight }}kg</td>
                <td class="border">{{ \Carbon\Carbon::tomorrow() }}</td>
                <td class="border">12</td>
              </tr>
            @endforeach
        </tbody>
      </table>
      @if ($orders->count() === 0)
      <p class="text-center p-4">Up-to-date with orders</p> 
      @else<button onclick="return confirm('Please confirm you would like to create a csv');" class="px-4 py-3 bg-theme text-white rounded-lg self-center mt-4" type="submit" form="csv-form">Create CSV</button>
    </form>
      @endif
      {{$orders->links()}}
              
    </div>
    

</div>
@endsection