<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $validator = \Validator::make(
            $request->only('product_id', 'amount'), 
            [
                'product_id' => 'required|integer|exists:products,id',
                'amount' => 'required|integer|min:1'
            ]
        ); 

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $purchase_order = new PurchaseOrder($request->only('product_id', 'amount'));  
        $purchase_order->source = 'api';

        //incremento da quantidade do produto 
        if($purchase_order->save()){
            $product = Product::find($request->product_id);     
            $product->amount += $request->amount;
            $product->save();
        }
        return response()->json($purchase_order, 201);
    }
}
