<?php

namespace App\Http\Controllers;

use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $orders = Order::where("fulfilled", false)->latest()->paginate(20); 
        foreach($orders as $order)
        {
            if ($order->product = "Wild Grown Frozen Açai Purée") {
                $order->product = 'Frozen';
            }
        }

        return view('home', [
            'orders' => $orders
        ]);
    }

    public function fetch()
    {
        $response = Http::withHeaders(["Content-Type"=> "application/json",
        "Authorization" => env('SQ_SPACE_API_KEY'),
        "User-Agent"=> "test",])->get('https://api.squarespace.com/1.0/commerce/orders', [
            'fulfillmentStatus' => 'PENDING',
        ]);

        $orders = json_decode($response->body());

        foreach($orders->result as $order){
            // check order no doesn't exist
            $existingOrder = Order::select("*")->where('order_number', $order->orderNumber)->get();

            if ($existingOrder->count() === 0) {
                // add new order to table
                Order::create([
                    'order_id' => $order->id,
                    'order_number' => $order->orderNumber,
                    'order_date' => new DateTime($order->createdOn),
                    'weight' => $order->lineItems[0]->weight, 
                    'quantity' => $order->lineItems[0]->quantity, 
                    'product' => $order->lineItems[0]->productName, 
                    'shipping' => $order->shippingLines[0]->method, 
                    'fulfilled' => false
                ]);
            }

        }
        return back();
        }
    
}
