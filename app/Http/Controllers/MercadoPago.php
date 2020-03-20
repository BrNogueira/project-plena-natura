<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MP;
use App\Product;

class MercadoPago extends Controller
{
    public function createPreferencePayment(Request $r){

        MercadoPago\SDK::setClientId("YOUR_CLIENT_ID");
        MercadoPago\SDK::setClientSecret("YOUR_CLIENT_SECRET");

        $cart = unserialize(\Cookie::get('cart'));
        foreach($cart as $product => $p){
            $item = $p;
        }
        $product = Product::find($item['product_id']);
        // dd($product);
        
        $preference_data = [
            "items" => [
                [
                "id" => $item["product_id"],
                "title" => $product->name,
                "description" => $product->description,
                "picture_url" => null,//aguardando ajuste posterior
                "quantity" => $item["quantity"],
                "currency_id" => 'R$',
                "unit_price" => $product->price
                ]
            ],
            "payer" => [
                "email" => "robert.rquadros@gmail.com",//\Auth::user()->email
            ]
        ];
        $preference = MP::zpost("/checkout/preferences",$preference_data);
        return dd($preference);
  }
}
