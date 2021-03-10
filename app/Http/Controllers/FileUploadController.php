<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv|max:2048',
        ]);
  
        $fileName = time().'.'.$request->file->extension();  
        $csv = array_map('str_getcsv', file($request->file));
        array_walk($csv, function(&$a) use ($csv) {
          $a = array_combine($csv[0], $a);
        });

        array_shift($csv);
        $fulfilledOrders = [];
        foreach ($csv as $order) {
            if (is_numeric($order['Reference 1'])) {
               $fulfilledOrders[$order['Reference 1']] = $order['Consignment'];
            }
        }

        // dd($fulfilledOrders);
   
        return back()
            ->with('success','File upload successful')
            ->with('file', $fulfilledOrders);
    }
}
