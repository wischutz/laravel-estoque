<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name')->get();

        return view('admin.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
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
            'name' => 'required|max:50',
            'sku' => 'required|unique:products|max:20',
            ]);

        $product = new Product($validatedData);

        $product->save(); 

        return redirect()->route('product.index');
    }  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        
        return view('admin.product.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'sku' => 'required|unique:products,sku,'.$id.'|max:20',
            ]);

        $product = Product::find($id);        
        
        $product->name =  $validatedData['name'];
        $product->sku =  $validatedData['sku'];

        $product->save();

        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id); 

        $purchase_orders_relations = PurchaseOrder::where('product_id', $id)->count();
        $sales_orders_relations = SalesOrder::where('product_id', $id)->count();

        if(($purchase_orders_relations + $sales_orders_relations) > 0){
            return redirect()->back()->withErrors(['Cannot delete due existing relations with purchase or sales orders.']);
        }

        $product->delete();

        return redirect()->route('product.index');
    }

    public function report(){
        $purchase_orders_query = DB::table('purchase_orders')
                                    ->where('purchase_orders.amount','>', 0)
                                    ->select(
                                        DB::raw(
                                                'product_id, 
                                                products.name, 
                                                products.sku, 
                                                purchase_orders.id, 
                                                purchase_orders.amount, 
                                                purchase_orders.source, 
                                                DATE_FORMAT(purchase_orders.created_at,"%Y-%m-%d") as created_at,                                                 
                                                \'purchase\' as type'
                                                )
                                            )
                                    ->join('products','product_id','=','products.id');

        $orders = DB::table('sales_orders')
                            ->where('sales_orders.amount','>', 0)
                            ->select(
                                DB::raw(
                                        'product_id, 
                                        products.name, 
                                        products.sku, 
                                        sales_orders.id, 
                                        sales_orders.amount, 
                                        sales_orders.source, 
                                        DATE_FORMAT(sales_orders.created_at,"%Y-%m-%d") as created_at,                                        
                                        \'sale\' as type'
                                        )
                                    )
                            ->union($purchase_orders_query)
                            ->join('products','product_id','=','products.id')
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('name', 'ASC')
                            ->orderBy('type')
                            ->get();                             

        return view('admin.product.report')->with('orders', $orders);
    }
}
