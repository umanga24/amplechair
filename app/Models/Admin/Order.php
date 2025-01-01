<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $fillable = ['name', 'email', 'phone', 'message', 'location', 'product_id', 'price', 'discount', 'status', 'order_id', 'quantity'];
    // for admin 
    public function productInfo(){
        return $this->hasOne('App\Models\Admin\Product', 'id', 'product_id');
    }
}
