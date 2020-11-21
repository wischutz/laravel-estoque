<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesOrder;

class SalesOrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $products =  Product::all();
        return view('admin.remove_product')->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'amount' => 'required|integer|min:1|max:'.$product->amount
            ]);

        $sales_order = new SalesOrder($validatedData);

         //decremento da quantidade do produto 
         if($sales_order->save()){            
            $product->amount -= $validatedData['amount'];
            $product->save();
        }
        return redirect()->route('admin');
    }
}
