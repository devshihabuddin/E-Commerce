<?php
//Frontend section

//authentication
Route::get('user/auth',[IndexController::class,'userAuth'])->name('user.auth');
Route::post('user/login',[IndexController::class, 'login'])->name('login.submit');
Route::post('user/register',[IndexController::class, 'register'])->name('register');
Route::get('user/logout',[IndexController::class, 'userLogout'])->name('user.logout');


Route::get('/',[App\Http\Controllers\Frontend\IndexController::class, 'home'])->name('front.home');

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



//End Frontend section

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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