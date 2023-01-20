<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('4')->get();
        $promo_banner = Banner::where(['status'=>'active','condition'=>'promo'])->orderBy('id','DESC')->first();
        $categories = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('6')->get();
        $new_products = Product::where(['status'=>'active','conditions'=>'new'])->orderBy('id','DESC')->limit('10')->get();
        $feature_products=Product::where(['status'=>'active','is_featured'=>1])->orderBy('id','DESC')->limit('6')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('id','DESC')->get();

        //try something diffrent
        //$cats = Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();

        //best selling products
        $items = DB::table('product_orders')->select('product_id',DB::raw('COUNT(product_id) as count'))->groupBy('product_id')->orderBy('count','desc')->get();
        
        $product_ids =[];
        foreach($items as $item){
            array_push($product_ids,$item->product_id);
        }
        $best_sellings=Product::whereIn('id',$product_ids)->get();

        //TOp rated product
        $item_rated=DB::table('product_reviews')->select('product_id',DB::raw('AVG(rate) as count'))->groupBy('product_id')->orderBy('count','desc')->get();
        $product_ids =[];
        foreach($item_rated as $item){
            array_push($product_ids,$item->product_id);
        }
        $best_rated=Product::whereIn('id',$product_ids)->get();
        //return $best_rated;




        $products = Product::query();

        if(!empty($_GET['category'])){
            $slugs = explode(',',$_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
           // return $cat_ids;
           $products = $products->whereIn('cat_id',$cat_ids);
           //return $products;
        }
        //brand fillter
        if(!empty($_GET['brand'])){
            $slugs = explode(',',$_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
           // return $cat_ids;
           $products = $products->whereIn('brand_id',$brand_ids);
           //return $products;
        }
        //size filter
        if(!empty($_GET['size'])){
           $products = $products->where('size',$_GET['size']);
           //return $products;
        }
        
        
        if(!empty($_GET['sortBy'])){

           // $sort = $_GET['sortBy'];

            if($_GET['sortBy']=='priceAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','ASC');
            }
            if($_GET['sortBy']=='priceDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','DESC');
            }
            if($_GET['sortBy']=='discAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','ASC');
            }
            if($_GET['sortBy']=='discDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','DESC');
            }
            if($_GET['sortBy']=='titleAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='titleDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','DESC');
            }
        }
        if(!empty($_GET['price'])){
            $price = explode('-',$_GET['price']);
            $price[0]=floor($price[0]);
            $price[1]=ceil($price[1]);
            $products= $products->whereBetween('price',$price)->where('status','active')->paginate(12);

        }
        else{
            $products=$products->where('status','active')->paginate(12);
        }

        $brands = Brand::where('status','active')->orderBy('title','ASC')->with('products')->get();
        $cats = Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();

        //return view('Frontend.pages.product.shop',compact('products','cats','brands'));
    
        

        return view('Frontend.index',compact('banners','categories','new_products','feature_products','promo_banner','brands','best_sellings','best_rated','products','cats','brands'));
    }

    //auout us
    public function aboutUs(){
        $about = AboutUs::first();
        $brands = Brand::where(['status'=>'active'])->orderBy('id','DESC')->get();
        return view('Frontend.pages.about_us',compact('about','brands'));
    }

    //contact us
    public function contactUs(){
        return view('Frontend.pages.contact_us');
    }
    //shop section
    public function shop(Request $request){

        
        $products = Product::query();

        if(!empty($_GET['category'])){
            $slugs = explode(',',$_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
           // return $cat_ids;
           $products = $products->whereIn('cat_id',$cat_ids);
           //return $products;
        }
        //brand fillter
        if(!empty($_GET['brand'])){
            $slugs = explode(',',$_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
           // return $cat_ids;
           $products = $products->whereIn('brand_id',$brand_ids);
           //return $products;
        }
        //size filter
        if(!empty($_GET['size'])){
           $products = $products->where('size',$_GET['size']);
           //return $products;
        }
        
        
        if(!empty($_GET['sortBy'])){

           // $sort = $_GET['sortBy'];

            if($_GET['sortBy']=='priceAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','ASC');
            }
            if($_GET['sortBy']=='priceDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','DESC');
            }
            if($_GET['sortBy']=='discAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','ASC');
            }
            if($_GET['sortBy']=='discDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','DESC');
            }
            if($_GET['sortBy']=='titleAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='titleDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','DESC');
            }
        }
        if(!empty($_GET['price'])){
            $price = explode('-',$_GET['price']);
            $price[0]=floor($price[0]);
            $price[1]=ceil($price[1]);
            $products= $products->whereBetween('price',$price)->where('status','active')->paginate(12);

        }
        else{
            $products=$products->where('status','active')->paginate(12);
        }

        $brands = Brand::where('status','active')->orderBy('title','ASC')->with('products')->get();
        $cats = Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();

        return view('Frontend.pages.product.shop',compact('products','cats','brands'));
    }
    public function shopFilter(Request $request){
        $data = $request->all();
        
        //category filter
        $catUrl = '';
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catUrl)){
                    $catUrl .='&category='.$category;
                }
                else{
                    $catUrl .=','.$category;
                }
            }
        }

        //sort filter
        $sortByUrl ='';
        if(!empty($data['sortBy'])){
            $sortByUrl .='&sortBy='.$data['sortBy'];
        }

        //price filter
        $price_range_url = '';
        if(!empty($data['price_range'])){
            $price_range_url .='&price='.$data['price_range'];
        }
        //brand filter
        $brandUrl='';
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandUrl)){
                    $brandUrl .='&brand='.$brand;
                }
                else{
                    $brandUrl .=','.$brand;
                }
            }
        }
        //size filter
        $sizeUrl='';
        if(!empty($data['size'])){
            $sizeUrl .='&size='.$data['size'];
        }
       
        return redirect()->route('shop',$catUrl.$sortByUrl.$price_range_url.$brandUrl.$sizeUrl);
    }

    //autocompletesearch
    public function autoSearch(Request $request){
        $query = $request->get('term','');
        $products = Product::where('title','LIKE','%'.$query.'%')->get();

        $data = array();
        foreach($products as $product){
            $data[]=array('value'=>$product->title,'id'=>$product->id);
        }
        if(count($data)){
            return $data;
        }
        else{
            return ['value'=>"No Result Found",'id'=>''];
        }
    }
    //search product
    public function search(Request $request){
        $query=$request->input('query');
        $products=Product::where('title','LIKE','%'.$query.'%')->orderBy('id','DESC')->paginate(12);

        $brands = Brand::where('status','active')->orderBy('title','ASC')->with('products')->get();
        $cats = Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();
        return view('Frontend.pages.product.shop',compact('products','cats','brands'));
    }


    // category product
    public function productCategory(Request $request,$slug){
       // dd($slug);
      // return $request->all();
      $category = Category::with('products')->where('slug',$slug)->first();

       $sort = '';

       if($request->sort !=null){
           $sort = $request->sort;
       }
       if($category==null){
           return view('errors.404');
       }
       else{
           if($sort == 'priceAsc'){
               $products = Product::where(['status'=>'active','cat_id'=>$category->id])->orderBy('price','ASC')->paginate(12);
           }
           elseif($sort=='priceDesc'){
               $products = Product::where(['status'=>'active','cat_id'=>$category->id])->orderBy('price','DESC')->paginate(12);
           }
           elseif($sort=='discAsc'){
               $products = Product::where(['status'=>'active','cat_id'=>$category->id])->orderBy('offer_price','ASC')->paginate(12);
           }
           elseif($sort=='discDesc'){
               $products = Product::where(['status'=>'active','cat_id'=>$category->id])->orderBy('offer_price','DESC')->paginate(12);
           }
           elseif($sort=='titleAsc'){
               $products = Product::where(['status'=>'active','cat_id'=>$category->id])->orderBy('title','ASC')->paginate(12);
           }
           elseif($sort=='titleDesc'){
               $products = Product::where(['status'=>'active','cat_id'=>$category->id])->orderBy('title','DESC')->paginate(12);
           }
           else{
               $products = Product::where(['status'=>'active','cat_id'=>$category->id])->paginate(12);
           }
       }

       $route = 'product-category';

       if($request->ajax()){
           $view=view('Frontend.pages.product.single-product',compact('products'))->render();
           return response()->json(['html'=>$view]);
       }

       return view('Frontend.pages.product.product-category',compact('category','route','products'));
    }

    //product details
    public function productDetails($slug){
       $product = Product::with('related_products')->where('slug',$slug)->first();
       //return $product;
       return view('Frontend.pages.product.product-details',compact('product'));
    }

    //user auth
    public function userAuth(){
        Session::put('url.intended',URL::previous());
        return view('Frontend.Auth.auth');
    }

    public function login(Request $request){
       // return $request->all();
        $this->validate($request,[

            'email'    => 'email|required|exists:users,email',
            'password' => 'required|min:3',
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'active'])){

            Session::put('user',$request->email);
            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }else{
                
                return redirect()->route('front.home')->with('success','Successfully Login.');
            }
            
        }else{
            return back()->with('error','Invalid Email & Password!');
        }
    }
    //register
    public function register(Request $request){

        $this->validate($request,[
            'full_name' => 'required|string',
            'username'  => 'nullable|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:4|confirmed'

        ]);
        $data = $request->all();
        $check = $this->create($data);

        Session::put('user',$data['email']);
        Auth::login($check);
        
        return redirect()->route('front.home')->with('success','Successfully Registered');
    }
    public function create(array $data){
        return User::create([
            'full_name' => $data['full_name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password'])
        ]);
    }

    //user logout
    public function userLogout(){
        Session::forget('user');
        Auth::logout();
        
        return redirect()->route('front.home')->with('success','Successfully Logout');
    }

    //user account dashboard
    public function userDashboard(){
        $user = Auth::user();
       // dd($user);
        return view('Frontend.user-account.dashboard',compact('user'));
    }
    public function userOrder(){
        $user = Auth::user();
        return view('Frontend.user-account.order',compact('user'));
    }
    public function userAddress(){
        $user = Auth::user();
        return view('Frontend.user-account.address',compact('user'));
    }
    public function userAccountDetails(){
        $user = Auth::user();
        return view('Frontend.user-account.account-details',compact('user'));
    }
    // user address & shipping address
    public function billingAddress(Request $request,$id){
        $user = User::where('id',$id)->update(['country'=>$request->country,'city'=>$request->city,'state'=>$request->state,'postcode'=>$request->postcode,'address'=>$request->address]);
        
        return back()->with('success','Billing Address successfully Updated.');
    }
    public function ShippingAddress(Request $request,$id){
        
        $user = User::where('id',$id)->update(['scountry'=>$request->scountry,'scity'=>$request->scity,'sstate'=>$request->sstate,'spostcode'=>$request->spostcode,'saddress'=>$request->saddress]);
        
        return back()->with('success','Shipping Address successfully Updated.');
    }

    //update account
    public function UpdateAccount(Request $request,$id){
        $this->validate($request,[
            'newpassword' => 'nullable|min:3',
            'oldpassword' => 'nullable|min:3',
            'full_name'   => 'required|string',
            'username'    => 'nullable|string',
            'phone'       => 'nullable|min:8'
        ]);
       $hashpassword = Auth::user()->password;
        if($request->oldpassword==null && $request->newpassword==null){
            User::where('id',$id)->update(['full_name'=>$request->full_name,'username'=>$request->username,'phone'=>$request->phone]);
            return back()->with('success',"Account successfully Updated.");

        }      
        else{
            if(Hash::check($request->oldpassword,$hashpassword)){
                if(!Hash::check($request->newpassword,$hashpassword)){
                    User::where('id',$id)->update(['full_name'=>$request->full_name,'username'=>$request->username,'phone'=>$request->phone,'password'=>Hash::make($request->newpassword)]);
                    return back()->with('success',"Account successfully Updated.");
                }else{
                    return back()->with('error',"New Password can't be same with old password");
                }
            }
            else{
                return back()->with('error',"Password doesn't match");
            }
        }
    }
}
