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


        \MercadoPago\SDK::setAccessToken("APP_USR-2196376508113415-081623-a61193f9d5ca9503569d20003c454c3a_LA_LD_-42899968");
        $payment = new \MercadoPago\Payment();

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

    public function createOrder()
    {

    }

    public function createUser()
    {

    }

    public function createUserAddress()
    {}
}
