<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MakeCSVController extends Controller
{
    public function make(Request $request)
    {
        $orders = [];
        foreach($request->request as $order_number => $checked) {
            if ($order_number !== "_token") {
                array_push($orders, $order_number);
            }
        }
        
        $ordersForCSV = Order::select(['order_number', 'delivery_contact_name', 'delivery_addressline1', 'delivery_addressline2', 'delivery_post_code', 'notification_sms', 'notification_email', 'quantity', 'weight'])->whereIn('order_number', $orders)->get();

        $columns = ['customer_ref1', 'delivery_contact_name', 'delivery_addressline1', 'delivery_addressline2', 'delivery_post_code', 'delivery_instructions', 'delivery_contact_no', 'notification_sms', 'notification_email', 'number_of_parcels', 'total_weight', 'shipment_date', 'Delivery Service code'];

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($ordersForCSV, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($ordersForCSV as $order) {
                $num_of_parcels = 1;
                if ($order->weight > 3) {
                    $num_of_parcels = ceil($order->weight / 3);
                }
                fputcsv($file, [$order->order_number, $order->delivery_contact_name, $order->delivery_addressline1, $order->delivery_addressline2, $order->delivery_post_code, "DO NOT LEAVE", $order->notification_sms, $order->notification_sms, $order->notification_email, $num_of_parcels, $order->weight, Carbon::tomorrow(), 12]);
                Order::where("order_number", $order->order_number)->update(['courier_informed' => true]);
            }

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    
}
