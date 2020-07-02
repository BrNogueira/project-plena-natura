<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Coupon;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $products_ids = [];

        if(\Auth::guest()){
            $data['products'] = unserialize(\Cookie::get('cart'));
        }else{
            $data['products'] = Cart::where('user_id', \Auth::id())->get();
        }

        foreach ( $data['products'] as $key => $product ) {
            $products_ids[] = $product['product_id'];
        }

        $data['products_id'] = implode(',', $products_ids);


        return view('products.cart', $data);
    }

    public function addToCart(Request $request){
        if(\Auth::guest()){

            $products = array();

            if(\Cookie::get('cart') != false){
                $products = unserialize(\Cookie::get('cart'));
            }
            if(empty(array_keys(array_column($products,'product_id'), $request->product_id))){
                $products[] = array('product_id' => $request->product_id,
                                    'quantity' => 1);
            }else{
                $id = array_keys(array_column($products,'product_id'), $request->product_id);
                $products[$id[0]]['quantity'] +=  1;
            }
            \Cookie::queue('cart', serialize($products), 172800);
            return redirect('/carrinho');
        }else{
            $check = Cart::where('product_id', $request->product_id)->where('user_id', \Auth::id())->first();
            if($check){
                $cart = Cart::find($check->id);
                $cart->quantity = $cart->quantity + 1;
                $cart->save();
            }else{
                $cart = new Cart;
                $cart->user_id    = \Auth::id();
                $cart->product_id = $request->product_id;
                $cart->quantity = 1;
                $cart->save();
            }
            return redirect('/carrinho');
        }
    }

    public function removeFromCart(Request $request){
        if(\Auth::guest()){
            $products = array();
            if(\Cookie::get('cart') != false){
                $products = unserialize(\Cookie::get('cart'));
            }
            $key = array_search($request->product_id, array_column($products,'product_id'));
            if(!empty($key) or $key == 0){
                unset($products[$key]);

                \Cookie::queue('cart', serialize($products), 172800);
                return response()->json(array("success" => true));
            }else{
                return response()->json(array("success" => false));
            }
        }else{
            $check = Cart::where('product_id', $request->product_id)->where('user_id', \Auth::id())->delete();
            if($check){
                return response()->json(array("success" => true));
            }else{
                return response()->json(array("success" => false));
            }
        }
    }
    public function insertCoupon(Request $request){
        $coupon = Coupon::where('name', $request->name)->first();
        if($coupon){
            session()->put('coupon', $coupon->value);
            $data['success'] = true;
            $data['value']   = $coupon->value;
            return response()->json($data);
        }else{
            return response()->json(array("success" => false));
        }
    }
    // public function getDeadline(Request $request){
    //     $cepOrigem  = '13058-971';
    //     $cepDestino = $request->cep;
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json',
    //             'x-api-key:  YKmJ1ImOOF2SxLNGNFvIS3KBWf8jUCTgGmt9zKg7',
    //         ),
    //         CURLOPT_URL => "https://api.kcep.run/".$cepOrigem."/".$cepDestino."/16/11/2/1" ,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_TIMEOUT => 30000,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //     ));
    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);

    //     return $response;
    // }
    // 
    
    public function getDeadline(Request $request){
        
        if (isset($request->product_id)) {
            $product = \App\Product::find($request->product_id);

            $response = $this->getProductShipping($product, $request->cep);

            return $response;
        } elseif (isset($request->products_id)) {
            $products_ids = explode(',', $request->products_id);

            if (count($products_ids) == 1) {
                $product = \App\Product::find($products_ids[0]);

                $response = $this->getProductShipping($product, $request->cep);

                return $response;
            } else {
                $products = [];

                foreach ($products_ids as $key => $product_id) {
                    $products[] = \App\Product::find($product_id);
                }

                $response = $this->getProductShipping($products, $request->cep);
            }

            return $response;
        }

        return false;
    }

    public function getProductShipping($product, $destination)
    {
        $origin = '13058-971';
        $correios = new Client;

        $freight = $correios->freight()
            ->origin($origin)
            ->destination($destination)
            ->services(Service::SEDEX, Service::PAC, Service::SEDEX_10);

        // largura, altura, comprimento, peso e quantidade
        if (is_object($product)) {
            $freight->item($product->width, $product->heigth, $product->length, $product->weight, 1);
        } else {
            foreach ($product as $p) {
                $freight = $freight->item($p->width, $p->heigth, $p->length, $p->weight, 1);
            }
        }

        return $freight->calculate();       
    }

    public function setDeadline(Request $request)
    {
        if($request->has('frete_type')){
            session()->put('frete', $request->frete_type);
            $data['success'] = true;
            $data['value']   = str_replace(',', '.', $request->frete_type);
            $data['type']    = $request->type;
            return response()->json($data);
        }else{
            return response()->json(array("success" => false));
        }
    }
}
