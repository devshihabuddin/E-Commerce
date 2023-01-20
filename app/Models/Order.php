<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'order_number',
        'sub_total',
        'total_amount',
        'quantity',
        'coupon',
        'payment_method',
        'payment_status',
        'condition',
        'delivery_charge',
        'first_name',
        'last_name',
        'email',
        'address',
        'phone',
        'country',
        'state',
        'postcode',
        'city',
        'note',
        'sfirst_name',
        'slast_name',
        'semail',
        'saddress',
        'sphone',
        'scountry',
        'sstate',
        'spostcode',
        'scity'
        
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot('quantity');
    }
}
