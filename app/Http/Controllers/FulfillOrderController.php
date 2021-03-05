<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FulfillOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function fulfill(Request $request)
    {
        dd($request);
    }
    
}
