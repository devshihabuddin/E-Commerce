<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'additional_info',
        'return_cancellation',
        'stock',
        'brand_id',
        'cat_id',
        'child_cat_id',
        'photo',
        'size_guide',
        'price',
        'offer_price',
        'discount',
        'size',
        'conditions',
        'vendor_id',
        'status',
        'user_id',
        'added_by',
        'is_featured'
    ];

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','cat_id','id');
    }

    public function related_products(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->limit(10);
    }

    public static function getProductByCart($id){
        return self::where('id',$id)->get()->toArray();
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'product_orders')->withPivot('quantity');
    }
}
