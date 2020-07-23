<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use \MercadoPago;
use App\Cart;
use App\User;
use App\Order;
use App\OrderItem;

class PaymentController extends Controller
{

    public function showCheckoutForm(Request $request)
    {
        $data['shippiments'] = isset($_COOKIE['shippiments']) ? json_decode($_COOKIE['shippiments']) : [];

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


        \MercadoPago\SDK::setAccessToken("TEST-4439526933134066-050319-fcd0ce70dd048f53bf0681c2fcb862f7-179181908");
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

            // return $payment->cause;

            if (property_exists($payment, 'status')) {
                
                // After payment, let's create the user if nessessary
                // if (condition) {
                    # code...
                // }
                $user = $this->getUser( $request );

                $order = $this->createOrder( $request, $payment, $user );
                

                if ($order) {
                    return response()->json([
                        'success' => true,
                        'return_url' => url('/recibo/?order=' . $order->id),
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'errors' => $payment
                    ]);
                }
                
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

    public function createOrder($request, $payment, $user)
    {

        $sub_total = cartTotal();
        
        
        try {
            $order = Order::create([
                'shipping_zipcode' => $request->shipping_zipcode,
                'shipping_street' => $request->shipping_street,
                'shipping_address2' => $request->shipping_address2,
                'shipping_number' => $request->shipping_number,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_shipping_type' => '',
                'installments' => $request->installments,
                'payment_method' => 'credit_card',
                'payment_gateway' => 'Mercado Pago',
                'shipping_total' => '',
                'coupon' => 0,
                'sub_total' => '',
                'total' => '',
                'order_status_id' => '',
                'user_id' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->createOrderItems($order);
        } catch (\Exeption $e) {
            return false;
        }
    }

    public function createOrderItems($order) {
        $products = [];

        if(\Auth::guest()){
            $products = unserialize(\Cookie::get('cart'));
        }else{
            $products = Cart::where('user_id', \Auth::id())->get();
        }

        if (count($products) > 0) {
            foreach ($products as $key => $product) {
                $p = product($product['product_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $p->price,
                    'quantity' => $product['quantity'],
                    'total' => $p->price *  $product['quantity']
                ]);
            }
        }
    }

    public function getUser($request)
    {
        if (\Auth::check()) {
            return \Auth::user();
        } else {
            return $this->createUser($request);
        }
    }

    public function createUser($request)
    {
        $birthday = str_replace('/', '-', $request->birth_date);

        return User::create([
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'name' => $request->first_name,
            'lastname' => $request->last_name,
            'provider' => 'cod',
            'cpf' => $request->cpf,
            'phone' => $request->shipping_cellphone,
            'type' => 'fisica',
            'birthday' => date('Y-m-d', strtotime($birthday)),
            'home_phone' => $request->phone
        ]);
    }

    public function createUserAddress()
    {}
}
