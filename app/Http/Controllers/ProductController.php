<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.product', compact('products'));
    }

    public function client()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('client.products.list_product',compact('products'));
    }

    public function clientShow($productCode)
    {
        $product = Product::where('product_code', $productCode)->first();
        return view('client.products.single_product', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'discount' => 'required',
            'dimension' => 'required',
            'unit' => 'required',
        ]);

        try {
            $data = $request->except('_token');
            Product::create($data);

            return redirect()->back()->with(['notif' => 'Success Add New Product']);
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->withErrors(['notif' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'discount' => 'required',
            'dimension' => 'required',
            'unit' => 'required',
        ]);

        try {
            $data = $request->except('_token');
            $product = Product::where('product_code', $data['product_code'])->first();
            $product->update($data);

            return redirect()->back()->with(['notif' => 'Success Update Product']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withErrors(['notif' => $th->getMessage()]);
        }
    }

}
