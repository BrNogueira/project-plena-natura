<?php

namespace App\Http\PaymentMethods;

use App\Order;
use Illuminate\Http\Request;
use MercadoPago\SDK;

class MercadoPago
{
  public function __construct()
  {
     SDK::setClientId(
          config("payment-methods.mercadopago.client")
     );
    SDK::setClientSecret(
          config("payment-methods.mercadopago.secret")
     );
  }

  public function setupPaymentAndGetRedirectURL(Order $order): string
  { 
     # Create a preference object
     $preference = new Preference();

      # Create an item object
      $item = new Item();
      $item->id = $order->id;
      $item->title = $order->title;
      $item->quantity = 1;
      $item->currency_id = 'ARS';
      $item->unit_price = $order->total_price;
      $item->picture_url = $order->featured_img;

      # Create a payer object
      $payer = new Payer();
      $payer->email = $order->preorder->billing['email'];

      # Setting preference properties
      $preference->items = [$item];
      $preference->payer = $payer;

      # Save External Reference
      $preference->external_reference = $order->id;
      $preference->back_urls = [
        "success" => route('checkout./recibo'),
        "pending" => route('checkout.cart'),
        "failure" => route('checkout.error'),
      ];
        
      $preference->auto_return = "all";
      $preference->notification_url = route('ipn');
      # Save and POST preference
      $preference->save();

      if (config('payment-methods.use_sandbox')) {
        return $preference->sandbox_init_point;
      }

      return $preference->init_point;
  }

  public function payment(){
    return redirect()->to($this->generatePaymentGateway());
  }

  public function generatePaymentGateway()
{
    // $mp = new MP (env('MP_CLIENT_ID'), env('MP_CLIENT_SECRET'));

    // $current_user = auth()->user();

    // $preferenceData = [
    //     'external_reference' => $this->id,
    //     'payer'              => [
    //     ],
    //     'back_urls'          => [
    //     ],
    //     'notification_url'   => env('MP_NOTIFICATION_URL')
    // ];

    // // add items
    // foreach ($this->items as $item):
    //     $preferenceData['items'][] = [
    //         'id'          => ...,
    //         'category_id' => ...,
    //         'title'       => ...,            
    //         'description' => ...,
    //         'picture_url' => ...,
    //         'quantity'    => ...,
    //         'currency_id' => ...,
    //         'unit_price'  => ...,
    //     ];
    // endforeach;

    // $preference = $mp->create_preference($preferenceData);
    // // also you can use try-catch for create the preference, DB transaction for the whole generatePaymentGateway method, etc...

    // // finally return init point to be redirected - or
    // // sandbox_init_point
    // return $preference['response']['init_point'];

    MercadoPago\SDK::setClientId("ENV_CLIENT_ID");
    MercadoPago\SDK::setClientSecret("ENV_CLIENT_SECRET");
    $payment = new MercadoPago\Payment();
    return $payment;
}
  
}