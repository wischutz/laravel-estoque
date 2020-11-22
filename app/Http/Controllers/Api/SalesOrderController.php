<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesOrder;

class SalesOrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //seleciona o produto para utilizar a quantidade atual como limite máximo na validação abaixo
        $product = Product::find($request->product_id);

        $validator = \Validator::make(
                                $request->only('product_id', 'amount'), 
                                [
                                    'product_id' => 'required|integer|exists:products,id',
                                    'amount' => 'required|integer|min:1|max:'.$product->amount
                                ]
                            );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $sales_order = new SalesOrder($request->only('product_id','amount'));
        $sales_order->source = 'api';

        //decremento da quantidade do produto 
        if($sales_order->save()){            
            $product->amount -= $request->amount;
            $product->save();
        }
        return response()->json($sales_order, 201);
    }
}
