<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use \MercadoPago;
use App\Cart;

class PaymentController extends Controller
{

    public function showCheckoutForm(Request $request)
    {
        if(\Auth::guest()){
//            $data['products'] = (object) unserialize(\Cookie::get('cart'));
            $data['products'] = unserialize(\Cookie::get('cart'));
        }else{
            $data['products'] = Cart::where('user_id', \Auth::id())->get();
        }

        return view('checkout', $data);
    }

    public function submitPayment(Request $request)
    {

//        MercadoPago\SDK::setClientId("YOUR_CLIENT_ID");
//        MercadoPago\SDK::setClientSecret("YOUR_CLIENT_SECRET");

//        MercadoPago\SDK::setAccessToken('TEST-4439526933134066-050319-fcd0ce70dd048f53bf0681c2fcb862f7-179181908');

//        $cart = unserialize(\Cookie::get('cart'));
//        foreach($cart as $product => $p){
//            $item = $p;
//        }
//        $product = Product::find($item['product_id']);
        // dd($product);

//        $preference_data = [
//            "items" => [
//                [
//                "id" => $item["product_id"],
//                "title" => $product->name,
//                "description" => $product->description,
//                "picture_url" => null,//aguardando ajuste posterior
//                "quantity" => $item["quantity"],
//                "currency_id" => 'R$',
//                "unit_price" => $product->price
//                ]
//            ],
//            "payer" => [
//                "email" => "robert.rquadros@gmail.com",//\Auth::user()->email
//            ]
//        ];
//        $preference = MP::post("/checkout/preferences",$preference_data);
//        return dd($preference);


        MercadoPago\SDK::setAccessToken("APP_USR-2196376508113415-081623-a61193f9d5ca9503569d20003c454c3a_LA_LD_-42899968");
        $payment = new MercadoPago\Payment();

        try {
            $payment->__set('transaction_amount', cartTotal());
            $payment->__set('token', $request->token);
            $payment->__set('description', 'Compra E-commerce');
            $payment->__set('installments', $request->installments);
            $payment->__set('payment_method_id', $request->payment_method_id);

            $payment->__set('payer', array(
                "email" => $request->email
            ));

            $payment->save();

            if (property_exists($payment, 'status')) {
                return response()->json([
                    'success' => true,
                    'status' => $payment->status
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'errors' => $payment
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }
}
