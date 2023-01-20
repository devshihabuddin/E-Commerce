<?php
//admin Login
Route::group(['prefix'=>'admin'],function(){
    Route::get('login',[LoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('login',[LoginController::class, 'login'])->name('admin.login');

});

//admin dashboard
Route::group(['prefix'=>'admin','middleware'=>['admin']],function(){
    Route::get('/',[AdminController::class,'admin'])->name('admin');

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
});