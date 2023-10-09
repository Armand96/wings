<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        /* VALIDATE DATA */
        $request->validate([
            'product_code' => 'required',
            'quantity' => 'required',
        ]);

        try {
            /* GET DATA */
            $data = $request->except(['_token']);
            $productInfo = Product::where('product_code', $data['product_code'])->firstOrFail();
            $data['user'] = Auth::user()->username;
            $data['price'] = $productInfo->discount <= 0 ? $productInfo->price : $productInfo->price - ($productInfo->price * $productInfo->discount) / 100;
            $data['subtotal'] = $data['price'] * $data['quantity'];

            /* CREATE OR UPDATE EXISTING DATA */
            $isProductExists = Cart::where('user', $data['user'])->where('product_code', $data['product_code'])->first();
            if ($isProductExists) {
                $isProductExists->quantity += $data['quantity'];
                $isProductExists->subtotal = $data['price'] * $isProductExists->quantity;
                $isProductExists->save();
            } else Cart::create($data);

            return response()->json(['message' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function changeQty(Request $request)
    {
        /* VALIDATE DATA */
        $request->validate([
            'product_code' => 'required',
            'quantity' => 'required',
        ]);

        try {
            $data = $request->except(['_token']);

            $productInfo = Product::where('product_code', $data['product_code'])->first();
            $data['price'] = $productInfo->discount <= 0 ? $productInfo->price : $productInfo->price - ($productInfo->price * $productInfo->discount) / 100;
            $cartInfo = Cart::where('product_code', $data['product_code'])->where('user', Auth::user()->username)->first();
            $cartInfo->quantity = $data['quantity'];
            $cartInfo->subtotal = $cartInfo->quantity * $data['price'];
            $cartInfo->save();

            return response()->json(['message' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function itemCount()
    {
        $dataCount = Cart::where('user', Auth::user()->username)->count();
        return response()->json(['dataCount' => $dataCount]);
    }

    public function checkoutPage()
    {
        $products = Cart::where('user', Auth::user()->username)->with('product')->orderBy('created_at', 'desc')->get();
        return view('client.checkout.checkout', compact('products'));
    }

    public function checkoutItem()
    {
        $user = Auth::user()->username;
        $productsData = Cart::where('user', $user)->with('product')->get();

        try {
            $dataCount = TransactionHeader::count() + 1;
            $trxCode = 'TRX';
            $documentNumber = str_pad($dataCount,3,"0", STR_PAD_LEFT);
            // dd($documentNumber);

            $total = 0;
            $trxBatchDetail = [];

            foreach ($productsData as $key => $cart) {
                $total += $cart->subtotal;

                $tempData = array(
                    'document_code' => $trxCode,
                    'document_number' => $documentNumber,
                    'product_code' => $cart->product_code,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                    'unit' => $cart->product->unit,
                    'subtotal' => $cart->subtotal,
                    'created_at' => date('Y-m-d H:i:s'),
                );

                array_push($trxBatchDetail, $tempData);
            }

            $dataTrxHeader = array(
                'document_code' => $trxCode,
                'document_number' => $documentNumber,
                'user' => Auth::user()->username,
                'total' => $total,
                'date' => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();

            TransactionHeader::create($dataTrxHeader);
            TransactionDetail::insert($trxBatchDetail);
            Cart::where('user', $user)->delete();

            DB::commit();

            return redirect()->route('client.products')->with(['notif' => 'Checkout Success']);

        } catch (\Throwable $th) {
            throw $th;
        }

    }

}
