<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  
  protected $fillable = [
    'price', 'quantity', 'total', 'product_id', 'order_id'
  ];
}
