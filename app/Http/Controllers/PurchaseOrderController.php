<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('admin.add_product')->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'amount' => 'required|integer|min:1'
            ]);

        $purchase_order = new PurchaseOrder($validatedData);        

        //incremento da quantidade do produto 
        if($purchase_order->save()){
            $product = Product::find($request->product_id);     
            $product->amount += $validatedData['amount'];
            $product->save();
        }
        return redirect()->route('product.index');
    }
}
