<?php 
return [ 

    'enabled' => [ 
        'Mercadopago', 
    ], 

    'use_sandbox' => env ('SANDBOX_GATEWAYS', true), 

    'Mercadopago' => [ 
        'logo'=>'/img/payment/Mercadopago.png', 
        'display'=>'MercadoPago', 
        'client'=> env ('MP_CLIENT'), 
        'secret'=> env ('MP_SECRET'),
        'access_token' => "TEST-7838241438764923-031700-5a3a985e4657adbbf5e8d1b5ccf88847-312590724" ,
        'public_key' => "TEST-d69d1967-d2df-40a2-ae3c-91c3a1518e75"
    ], 

];