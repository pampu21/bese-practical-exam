<?php

namespace App\Http\Controllers;

use App\Helpers\OrderHelper;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        $id = request('product_id');
        $qty = request('quantity');
        $data = OrderHelper::store($id,$qty);

        return response()->json(['message' => $data['msg']],$data['res']);
    }
}
