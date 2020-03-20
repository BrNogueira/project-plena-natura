<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $table = 'products';

    // static function item($id){
    //     return DB::table('products')->where('id', $id)->first();
    // }
}
