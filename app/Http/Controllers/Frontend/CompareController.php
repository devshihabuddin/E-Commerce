<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function compare(){
        return view('Frontend.pages.compare');
    }

    public function compareStore(Request $request){
        // dd($request->all());
        $product_id = $request->input('product_id');
        $product = Product::getProductByCart($product_id);
       // dd($product);
       $price = $product[0]['offer_price'];
       $compare_array =[];
       foreach(Cart::instance('compare')->content() as $item){
             $compare_array[] =$item->id;
       }
       if(in_array($product_id,$compare_array)){
 
             $response['present']=true;
             $response['message']="Item is already in your Compare.";
               
       }
       elseif(count($compare_array)>3){
           $response['status'] = false;
           $response['message'] = 'You can not add more than 4 items!';
       }
       elseif($product[0]['stock']<=0){
           $response['status']=false;
           $response['message']="we don't have enough items for compare!";
       }
       else{
           $result = Cart::instance('compare')->add($product_id,$product[0]['title'],1,$price)->associate('App\Models\Product');
           if($result){
               $response['status']=true;
               $response['message']="Item has been saved in Compare List.";
               $response['compare_count']= Cart::instance('compare')->count();
           }
       }
       return json_encode($response);
 
     }
 
     //add to cart wishlist
     public function moveToCart(Request $request){
        // dd($request->all());
        $item = Cart::instance('compare')->get($request->input('rowId'));
        
        Cart::instance('compare')->remove($request->input('rowId'));
        $result = Cart::instance('shopping')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        if($result){
            $response['status']=true;
            $response['message']="Item has move to Cart";
            $response['cart_count']=Cart::instance('shopping')->count();
        }
        if($request->ajax()){
            $wishlist = view('Frontend.layouts._wishlist')->render();
            $compare  = view('Frontend.layouts._compare')->render();
            $header   = view('Frontend.layouts.header')->render();
            $response['wishlist_count'] = $wishlist;
            $response['compare_count'] = $compare;
            $response['header'] = $header;
        }
        return $response;
     }

     //move to wishlist
     public function MoveToWishlist(Request $request){
        // dd($request->all());
        $item = Cart::instance('compare')->get($request->input('rowId'));
        
        Cart::instance('compare')->remove($request->input('rowId'));
        $result = Cart::instance('wishlist')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        if($result){
            $response['status']=true;
            $response['message']="Item has move to Wishlist";
        }
        if($request->ajax()){
            $wishlist = view('Frontend.layouts._wishlist')->render();
            $compare  = view('Frontend.layouts._compare')->render();
            $header   = view('Frontend.layouts.header')->render();
            $response['wishlist_count'] = $wishlist;
            $response['compare_count'] = $compare;
            $response['header'] = $header;
        }
        return $response;
     }
 
     //remove wishlist
     public function compareDelete(Request $request){
        $id = $request->input('rowId');
        Cart::instance('compare')->remove($id);
 
            $response['status']=true;
            $response['message']="Item Successfully removed from your Compare List";
            $response['cart_count']=Cart::instance('shopping')->count();
 
        if($request->ajax()){
         $wishlist = view('Frontend.layouts._wishlist')->render();
         $compare  = view('Frontend.layouts._compare')->render();
         $header   = view('Frontend.layouts.header')->render();
         $response['wishlist_count'] = $wishlist;
         $response['compare_count'] = $compare;
         $response['header'] = $header;
     }
     return $response;
     }
}
