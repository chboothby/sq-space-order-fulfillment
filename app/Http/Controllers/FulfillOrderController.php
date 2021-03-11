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

        // dd($request);

       foreach($request->request as $order_id => $tracking_no) {

       
        if ($tracking_no && $order_id !== "_token") {

            $this->validate($request, [
                $order_id => 'max:255|required',
            ]);
            
                      
            // get tracking info for order
            $shipping = Order::select('shipping')->where('order_id', $order_id)->get();
            // dd([$order_id, $shipping[0]->shipping, $tracking_no]);
            // dd(Carbon::now()->toIsoString());
          
            
            $response = Http::withHeaders(["Content-Type"=> "application/json",
            "Authorization" => env('SQ_SPACE_API_KEY'),
            "User-Agent"=> "test",])->post("https://api.squarespace.com/1.0/commerce/orders/$order_id/fulfillments", [
                'shouldSendNotification'=> "true",
                'shipments' => [[
                    'shipDate' => Carbon::now()->toIsoString(), 
                    'carrierName' => 'DPD', 
                    'service' => $shipping[0]->shipping, 
                    'trackingNumber' => "$tracking_no",
                ],]
            ]);


            Order::where("order_id", $order_id)->update(['fulfilled' => true, 'tracking_id' => "$tracking_no"]);
        }
       }

       return back();
    }

}
