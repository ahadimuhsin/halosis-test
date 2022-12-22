<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        DB::beginTransaction();
        //buat invoice
        $length = 10;
        $random = '';
        for($i=0; $i<$length;$i++)
        {
            $random .= rand(0,1) ? rand(0,9) : chr(rand(ord('a'), ord('z')));
        }

        $no_invoice = 'INV-'.Str::upper($random);

        try {
            //buat invoice baru
            $invoice = Invoice::create([
                'invoice' => $no_invoice,
                'user_id' => auth()->guard('api')->user()->id,
                'phone' => $request->phone,
                'address' => $request->address,
                'grand_total' => $request->grand_total,
            ]);
            //simpan ke tabel order
            foreach(Cart::where('user_id', auth()->guard('api')->user()->id)->get() as $cart)
            {

                $invoice->orders()->create([
                    'invoice_id' => $invoice->id,
                    'invoice' => $no_invoice,
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->name,
                    'qty' => $cart->qty,
                    'price' => $cart->price
                ]);
            }

            //hapus cart
            Cart::where('user_id', auth()->guard('api')->user()->id)
            ->delete();
            DB::commit();
        } catch (\Exception $e) {
            # code...
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Checkout Berhasil'
        ]);

    }
}
