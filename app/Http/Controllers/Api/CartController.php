<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function saveCart(Request $request)
    {
         //set validation
         $validator = Validator::make($request->all(), [
            'product_id'     => 'required',
            'qty' => 'required|integer',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //ambil data harga produk
        $product_price = Product::where('id', $request->product_id)->pluck('price')->first();
        // dd($product);
        //cek terlebih dahulu apakah produk id dan user id sudah ada di db
        $carts = Cart::where('product_id', $request->product_id)
        ->where('user_id', auth()->guard('api')->user()->id);

        $qty = $request->qty;
        $price = $qty * $product_price;

        //jika ada datanya, update
        if($carts->count())
        {
            $carts->update([
                'qty' => $qty,
                'price' => $price
            ]);
        }
        else
        {
            $carts = Cart::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->guard('api')->user()->id,
                'qty' => $qty,
                'price' => $price,

            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success Add To Cart',
        ]);
    }
}
