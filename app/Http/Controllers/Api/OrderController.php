<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::with(['product', 'invoice.customer'])->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Order Berhasil Didapatkan',
            'data' => $orders
        ]);
    }

    public function orderDetail($id)
    {
        $order = Order::with(['product', 'invoice.customer'])
        ->where('id', $id)
        ->first();

        if(!$order)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Order Tidak Dapat Didapatkan'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data Order Berhasil Didapatkan',
            'data' => $order
        ]);
    }
}
