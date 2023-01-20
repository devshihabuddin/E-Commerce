<?php


use App\Http\Controllers\AboutusController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Seller\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\currencyController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Frontend section

//authentication
Route::get('user/auth',[IndexController::class,'userAuth'])->name('user.auth');
Route::post('user/login',[IndexController::class, 'login'])->name('login.submit');
Route::post('user/register',[IndexController::class, 'register'])->name('register');
Route::get('user/logout',[IndexController::class, 'userLogout'])->name('user.logout');


Route::get('/',[App\Http\Controllers\Frontend\IndexController::class, 'home'])->name('front.home');

//auout us
Route::get('about-us',[IndexController::class,'aboutUs'])->name('about.us');

//auout us
Route::get('contect-us',[IndexController::class,'ContactUs'])->name('contact.us');

//useraccount dashboard
Route::group(['prefix'=>'user'],function(){
    Route::get('/dashboard',[IndexController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/order',[IndexController::class, 'userOrder'])->name('user.order');
    Route::get('/address',[IndexController::class, 'userAddress'])->name('user.address');
    Route::get('/account-details',[IndexController::class, 'userAccountDetails'])->name('user.account-details');

    //user address
    Route::post('/billing/address/{id}',[IndexController::class, 'billingAddress'])->name('billing.address');
    Route::post('/billing/shipping-address/{id}',[IndexController::class, 'ShippingAddress'])->name('shipping.address');

    //user update account
    Route::post('/update/account/{id}',[IndexController::class, 'UpdateAccount'])->name('update.account');

    

});

//product category
Route::get('product-category/{slug}',[IndexController::class, 'productCategory'])->name('product.category');

//product details
Route::get('product-details/{slug}',[IndexController::class, 'productDetails'])->name('product.details');

//product review
Route::post('product-review/{slug}', [ProductReviewController::class, 'productReview'])->name('product.review');

//cart section
Route::get('cart',[CartController::class, 'cart'])->name('cart');
Route::post('cart/store',[CartController::class, 'cartStore'])->name('cart.store');
Route::post('cart/delete',[CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/update',[CartController::class, 'cartUpdate'])->name('cart.update');

//coupon section
Route::post('coupon/add',[CartController::class, 'couponAdd'])->name('coupon.add');

//wishlist section
Route::get('wishlist',[WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('wishlist/store',[WishlistController::class, 'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move-to-cart',[WishlistController::class, 'MoveToCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete',[WishlistController::class, 'wishlistDelete'])->name('wishlist.delete');

//compare section
Route::get('compare',[CompareController::class, 'compare'])->name('compare');
Route::post('compare/store',[CompareController::class, 'compareStore'])->name('compare.store');
Route::post('compare/move-to-cart',[CompareController::class, 'MoveToCart'])->name('compare.move.cart');
Route::post('compare/move-to-wishlist',[CompareController::class, 'MoveToWishlist'])->name('compare.move.wishlist');
Route::post('compare/delete',[CompareController::class, 'compareDelete'])->name('compare.delete');

//checkout section
Route::get('checkout1',[CheckoutController::class, 'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-first',[CheckoutController::class, 'checkout1Store'])->name('checkout1.store');
Route::post('checkout-two',[CheckoutController::class, 'checkout2Store'])->name('checkout2.store');
Route::post('checkout-three',[CheckoutController::class, 'checkout3Store'])->name('checkout3.store');
Route::get('checkout-store',[CheckoutController::class, 'checkout4Store'])->name('checkout4.store');
Route::get('checkout-complete/{order}',[CheckoutController::class, 'checkoutComplete'])->name('checkout.complete');

//shop section
Route::get('shop',[IndexController::class, 'shop'])->name('shop');
Route::post('shop-filter', [IndexController::class, 'shopFilter'])->name('shop.filter');

//search product && autosearch
Route::get('autosearch',[IndexController::class, 'autoSearch'])->name('autosearch');
Route::get('search',[IndexController::class, 'search'])->name('search');

//currency section
Route::post('currency_load',[currencyController::class, 'currencyLoad'])->name('currency.load');





//End Frontend section

Auth::routes(['register'=>false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin Login
Route::group(['prefix'=>'admin'],function(){
    Route::get('login',[LoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('login',[LoginController::class, 'login'])->name('admin.login');

});

//admin dashboard
Route::group(['prefix'=>'admin','middleware'=>['admin']],function(){
    Route::get('/',[AdminController::class,'admin'])->name('admin');

    //about us
    Route::get('aboutus',[AboutusController::class, 'index'])->name('about.index');
    Route::put('aboutus-update',[AboutusController::class, 'aboutusUpdate'])->name('about.update');


    //Banner section
    Route::resource('banner',BannerController::class);
    Route::post('banner_status',[BannerController::class, 'bannerstatus'])->name('banner.status');

    //category section
    Route::resource('category',CategoryController::class);
    Route::post('category_status',[CategoryController::class, 'categorystatus'])->name('category.status');

    Route::post('category/{id}/child',[CategoryController::class, 'getChildByParentID']);

    //brand section
    Route::resource('brand',BrandController::class);
    Route::post('brand_status',[BrandController::class,'brandstatus'])->name('brand.status');

     //product section
     Route::resource('product',ProductController::class);
     Route::post('product_status',[ProductController::class,'productstatus'])->name('product.status');
     //product attribute section
     Route::post('product-attribute/{id}', [ProductController::class, 'addProductAttribute'])->name('product.attribute');
     Route::delete('product-attribute-delete/{id}', [ProductController::class, 'roductAttributeDelete'])->name('product.attribute.destroy');


     //user section
     Route::resource('user',UserController::class);
     Route::post('user_status',[UserController::class,'userstatus'])->name('user.status');

     //coupon section
     Route::resource('coupon',CouponController::class);
     Route::post('coupon_status',[CouponController::class, 'couponStatus'])->name('coupon.status');

     //shipping section
     Route::resource('shipping',ShippingController::class);
     Route::post('shipping_status',[ShippingController::class, 'shippingStatus'])->name('shipping.status');

     //currency section
     Route::resource('currency',currencyController::class);
     Route::post('currency_status',[currencyController::class, 'currencyStatus'])->name('currency.status');

     //Order section
     Route::resource('order',OrderController::class);
     Route::post('order-status',[OrderController::class, 'orderStatus'])->name('order.status');

     //Setting section
     Route::get('settings',[SettingsController::class, 'settings'])->name('settings');
     Route::put('settings-update',[SettingsController::class, 'settingsUpdate'])->name('settings.update');

     //Seller section
     Route::resource('seller',SellerController::class);
     Route::post('seller-status',[SellerController::class, 'sellerStatus'])->name('seller.status');
     Route::post('seller-verified',[SellerController::class, 'sellerVerified'])->name('seller.verified');


     //SMTP section
     Route::get('smtp',[SettingsController::class, 'smtp'])->name('smtp');
     Route::post('smtp-update',[SettingsController::class, 'smtpUpdate'])->name('smtp.update');



     
});

//photo
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


//Seller section
Route::group(['prefix'=>'seller'],function(){
    Route::get('/login',[AuthController::class,'showLoginForm'])->name('seller.login.form');
    Route::post('/login',[AuthController::class,'login'])->name('seller.login');
});

//seller dashboard
Route::group(['prefix'=>'seller','middleware'=>['seller']],function(){
    Route::get('/',[App\Http\Controllers\Seller\SellerController::class, 'dashboard'])->name('seller');

    //product section
    Route::resource('seller-product',App\Http\Controllers\Seller\ProductController::class);
    Route::post('seller_product_status',[App\Http\Controllers\Seller\ProductController::class,'sellerProductStatus'])->name('seller.product.status');
});

