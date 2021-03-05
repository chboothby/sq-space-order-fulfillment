<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FulfillOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function fulfill(Request $request)
    {
       foreach($request->request as $order_id => $tracking_no) {

       
        if ($tracking_no && $order_id !== "_token") {

            
            // $response = Http::withHeaders(["Content-Type"=> "application/json",
            // "Authorization" => env('SQ_SPACE_API_KEY'),
            // "User-Agent"=> "test",])->post("https://api.squarespace.com/1.0/commerce/orders/$order_id/fulfillments", [
            //     'shouldSentNotification'=> true,
            //     'shipments' => [
            //         'shipDate' => Carbon::now()->toIso8601String(), 
            //         'carrierName' => 'DPD', 
            //         'service' => "insert shipping type here", 
            //         'trackingNumber' => $tracking_no,
            //     ]
            // ]);

            //Order::where("order_id", $order_id)->update(['fulfilled' => true, 'tracking_id' => $tracking_no]);
        }
       }

       return back();
    }

}
