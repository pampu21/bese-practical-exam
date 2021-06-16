<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\Product;

class OrderHelper {
    public static function store($id,$qty)
    {
         $product = Product::firstWhere('id',$id);
         if($product->stock == 0){
            return self::failedOrder();
         }
         if($product->stock >= $qty){
             Order::create([
                'product_id' => $id,
                'quantity' => $qty
             ]);
             $product->stock = $product->stock - $qty;
             $product->save();
             return self::successOrder();
         }else{
            return self::failedOrder();
         }

    }
    public static function failedOrder()
    {
        $data = [];
        $msg = 'Failed to order this product due to unavailability of stock';
        $res = 400;

        return $data = ['msg' => $msg, 'res' => $res];
    }
    public static function successOrder()
    {
        $data = [];
        $msg = 'You have successfully ordered this product';
        $res = 201;

        return $data = ['msg' => $msg, 'res' => $res];
    }

}
