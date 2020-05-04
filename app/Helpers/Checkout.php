<?php

function months() {
    return [
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Março',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro',
    ];
}

function years() {
    $currentYear = (int) date('Y');
    $years  = [];
    $interval = 10;

    for($i = 0; $i < $interval; $i++) {
        $years[$i] = $currentYear;

        $currentYear++;
    }

    return $years;
}

function installments()  {
    $max_installments = 3;
    $total = cartTotal();
    $installments = [];

    for($i = 1; $i <= $max_installments; $i++) {
        $installments[$i] = $total / $i;
    }

    return $installments;
}


function cartTotal() {
    $total = 0;

    if(\Auth::guest()){
        $products = unserialize(\Cookie::get('cart'));
    }else{
        $products = Cart::where('user_id', \Auth::id())->get();
    }

    if(count($products) > 0) {
        foreach ($products as $product) {
            $p = product($product['product_id']);
            $line_total = $p->price *  $product['quantity'];

            $total += $line_total;
        }
    }

    return $total;
}
