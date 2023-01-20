@extends('Frontend.layouts.master')

@section('content')


    <!-- Welcome Slides Area -->
    <!-- @if(count($banners)>0)
        <section class="welcome_area">
                <div class="welcome_slides owl-carousel">
                    @foreach($banners as $banner)
                        
                        <div class="single_slide bg-img" style="background-image: url({{$banner->photo}});">
                            <div class="container h-100">
                                <div class="row h-100 align-items-center">
                                    <div class="col-7 col-md-8">
                                        <div class="welcome_slide_text">
                                            <h2 data-animation="fadeInUp" data-delay="300ms">{{$banner->title}}</h2>
                                            <h4 data-animation="fadeInUp" data-delay="600ms">{!! html_entity_decode($banner->description) !!}</h4>
                                            <a href="{{$banner->slug}}" class="btn btn-primary" data-animation="fadeInUp" data-delay="1s">Buy Now</a>
                                        </div>
                                    </div>
                                    <div class="col-5 col-md-4">
                                        <div class="welcome_slide_image">
                                            <img src="img/bg-img/slide-1.png" alt="" data-animation="bounceInUp" data-delay="500ms">
                                            <div class="discount_badge" data-animation="bounceInDown" data-delay="1.2s">
                                                <span>30%<br>OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
        </section>
    @endif  -->
    <!-- Welcome Slides Area -->
   
    <!-- Top Catagory Area -->
        <!-- @if(count($categories)>0)
        <div class="top_catagory_area mt-50 clearfix">
            <div class="container">
                <div class="row">
                
                    @foreach($categories as $cat)
                    <div class="col-12 col-md-4">
                        <div class="single_catagory_area mt-50">
                            
                            <a href="{{route('product.category',$cat->slug)}}"><h2>{{$cat->title}}</h2>
                                <img src="{{$cat->photo}}"  alt="{{$cat->title}}">
                            </a>
                        </div>
                    </div>
                    @endforeach

                    
                </div>
            </div>
        </div>
        @endif -->
    <!-- Top Catagory Area -->

   <!-- New Arrivals Area -->
    <!-- @if(count($new_products)>0)
    <section class="new_arrivals_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>New Arrivals</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="new_arrivals_slides owl-carousel">
                        
                        @foreach($new_products as $nproduct)
                            <div class="single-product-area">
                                <div class="product_image">
                                    
                                    @php
                                    $photo = explode(',',$nproduct->photo)

                                    @endphp
                                    <img class="normal_img" src="{{$photo[0]}}" alt="{{$nproduct->title}}">

                                    
                                        <div class="product_badge">
                                            <span class="badge-new">{{$nproduct->conditions}}</span>
                                        </div>
                                    

                                    
                                    <div class="product_wishlist">
                                        <a href="#" class="add_to_wishlist" data-id="{{$nproduct->id}}" data-quantity="1" id="add_to_wishlist_{{$nproduct->id}}"><i class="icofont-heart"></i></a>
                                    </div>

                                    
                                    <div class="product_compare">
                                    <a href="#" class="add_to_compare" data-id="{{$nproduct->id}}" id="add_to_compare_{{$nproduct->id}}"><i class="icofont-exchange"></i></a>
                                </div>
                                </div>

                                
                                <div class="product_description">
                                    
                                    <div class="product_add_to_cart">
                                        <a href="#" data-quantity="1" data-product-id="{{$nproduct->id}}" class="add_to_cart" id="add_to_cart{{$nproduct->id}}"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                    </div>

                                    
                                    
                                    <div class="product_quick_view">
                                        <a href="{{route('product.details',$nproduct->slug)}}"><i class="icofont-eye-alt"></i> View Details</a>
                                    </div>
                                    

                                    <p class="brand_name">{{\App\Models\Brand::where('id',$nproduct->brand_id)->value('title')}}</p>
                                    <a href="{{route('product.details',$nproduct->slug)}}">{{ucfirst($nproduct->title)}}</a>
                                    <h6 class="product-price">{{Helper::currency_converter($nproduct->offer_price)}} <small><del class="text-danger">{{Helper::currency_converter($nproduct->price)}}</del></small></h6>
                                </div>
                            </div>
                            
                           
                                
                        @endforeach
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    @endif -->
    <!-- New Arrivals Area -->


    <!-- try diffrent something -->

    <section class="shop_grid_area" style="margin-right: 10px; margin-left: 10px; margin-top: 20px;">
        
            <div class="row">
                <div class="col-12 col-sm-5 col-md-4 col-lg-3">
                    <form action="{{route('shop.filter')}}" method="POST">
                        @csrf
                        <div class="shop_sidebar_area">
                            @if(count($cats)>0)
                                <!-- Single Widget -->
                                <div class="widget catagory mb-30">
                                    <h6 class="widget-title">Product Categories</h6>
                                    <div class="widget-desc">
                                        @if(!empty($_GET['category']))
                                            @php
                                                $filter_cats = explode(',',$_GET['category'])
                                            @endphp
                                        @endif
                                        @foreach($cats as $cat)
                                        <!-- Single Checkbox -->
                                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                            <input type="checkbox" @if(!empty($filter_cats) && in_array($cat->slug,$filter_cats)) checked @endif class="custom-control-input" id="{{$cat->slug}}" name="category[]" onchange="this.form.submit();" value="{{$cat->slug}}">
                                            <label class="custom-control-label" for="{{$cat->slug}}">{{ucfirst($cat->title)}}<span class="text-muted">({{count($cat->products)}})</span></label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            
                            
                        </div>

                        
                    
                </div>

                <div class="col-12 col-sm-7 col-md-8 col-lg-9">

                    <section class="featured_product_area section_padding_10" style="margin-right: 10px;">
                        <div class="container">
                            <div class="row">
                                <!-- Featured Offer Area -->
                                <div class="col-12 col-lg-6">
                                    <div class="featured_offer_area d-flex align-items-center" style="background-image: url({{asset($promo_banner->photo)}});">
                                        <div class="featured_offer_text">
                                            <h4>{{$promo_banner->title}}</h4>
                                            <h2>{!! html_entity_decode($promo_banner->description) !!}</h2>
                                            
                                            <a href="{{route('shop')}}" class="btn btn-primary btn-sm mt-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Featured Product Area -->
                                <div class="col-12 col-lg-6">
                                    <div class="section_heading featured">
                                        <h5>Featured Products</h5>
                                    </div>

                                    <!-- Featured Product Slides -->
                                    <div class="featured_product_slides owl-carousel">
                                        <!-- Single Product -->
                                        @foreach($feature_products as $fproduct)
                                        <div class="single-product-area">
                                            <div class="product_image">
                                                <!-- Product Image -->
                                                @php
                                                    $photo = explode(',',$fproduct->photo)

                                                @endphp
                                                <img class="normal_img" src="{{$photo[0]}}" alt="{{$fproduct->title}}">

                                                <!-- Product Badge -->
                                                
                                                <div class="product_badge">
                                                    <span>{{$fproduct->conditions}}</span>
                                                </div>
                                                

                                                <!-- Wishlist -->
                                                <div class="product_wishlist">
                                                    <a href="#"  class="add_to_wishlist" data-id="{{$fproduct->id}}" data-quantity="1" id="add_to_wishlist_{{$fproduct->id}}" ><i class="icofont-heart"></i></a>
                                                </div>

                                                <!-- Compare -->
                                                <div class="product_compare">
                                                    <a href="#" class="add_to_compare" data-id="{{$fproduct->id}}" id="add_to_compare_{{$fproduct->id}}"><i class="icofont-exchange"></i></a>
                                                </div>
                                            </div>

                                            <!-- Product Description -->
                                            <div class="product_description">
                                                <!-- Add to cart -->
                                                <div class="product_add_to_cart">
                                                    <a href="#" data-quantity="1" data-product-id="{{$fproduct->id}}" class="add_to_cart" id="add_to_cart{{$fproduct->id}}"></i> Add to Cart</a>
                                                </div>

                                                <!-- Quick View -->
                                                <div class="product_quick_view">
                                                    <a href="{{route('product.details',$fproduct->slug)}}"><i class="icofont-eye-alt"></i> Quick View</a>
                                                </div>

                                                <a href="#">{{$fproduct->title}}</a>
                                                <h6 class="product-price">{{Helper::currency_converter($fproduct->offer_price)}} <small><del class="text-danger">{{Helper::currency_converter($fproduct->price)}}</del></small></h6>
                                                <div class="product_rating">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                
            
            </div>

            <div class="col-12" style="margin-top: 50px;">
                    <!-- Shop Top Sidebar -->
                    <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                        <div class="view_area d-flex">
                            <div class="grid_view">
                                <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="icofont-layout"></i></a>
                            </div>
                            <div class="list_view ml-3">
                                <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="List View"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <select name="sortBy" onchange="this.form.submit();" class="small right">
                            <option value=" ">Default Sort</option>
                            <option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc') selected @endif>Price - Lower To Higher</option>
                            <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc') selected @endif>Price - Higher To Lower</option>
                            <option value="titleAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleAsc') selected @endif>Alphabetical Ascending</option>
                            <option value="titleDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleDesc') selected @endif>Alphabetical Descending</option>
                            <option value="discAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discAsc') selected @endif>Discount - Lower To Higher</option>
                            <option value="discDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discDesc') selected @endif>Discount - Higher To Lower</option>
                        </select>
                    </div>

                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center">
                            @if(count($products)>0)
                                <!-- Single Product -->
                                @foreach($products as $product)
                                    <div class="col-9 col-sm-12 col-md-6 col-lg-2">
                                        <div class="single-product-area mb-30">
                                            <div class="product_image">
                                            @php
                                                    $photo = explode(',',$product->photo)
                                                @endphp
                                                <!-- Product Image -->
                                                <img class="normal_img" src="{{$photo[0]}}" alt="{{$product->title}}">
                                                <img class="hover_img" src="img/product-img/new-1.png" alt="">

                                                <!-- Product Badge -->
                                                <div class="product_badge">
                                                    <span>{{$product->conditions}}</span>
                                                </div>

                                                <!-- Wishlist -->
                                                <div class="product_wishlist">
                                                    <a href="#" class="add_to_wishlist" data-id="{{$product->id}}" data-quantity="1" id="add_to_wishlist_{{$product->id}}" ><i class="icofont-heart"></i></a>
                                                </div>

                                                <!-- Compare -->
                                                <div class="product_compare">
                                                    <a href="#" class="add_to_compare" data-id="{{$product->id}}" id="add_to_compare_{{$product->id}}"><i class="icofont-exchange"></i></a>
                                                </div>
                                            </div>

                                            <!-- Product Description -->
                                            <div class="product_description">
                                                <!-- Add to cart -->
                                                <div class="product_add_to_cart">
                                                    <a href="#" data-quantity="1" data-product-id="{{$product->id}}" class="add_to_cart" id="add_to_cart{{$product->id}}"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                                </div>

                                                <!-- Quick View -->
                                                <div class="product_quick_view">
                                                    <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
                                                </div>

                                                <p class="brand_name">{{\App\Models\Brand::where('id',$product->brand_id)->value('title')}}</p>
                                                <a href="{{route('product.details',$product->slug)}}">{{ucfirst($product->title)}}</a>
                                                <h6 class="product-price">{{Helper::currency_converter($product->offer_price)}} <small><del class="text-danger">{{Helper::currency_converter($product->price)}}</del></small></h6>
                                            </div>
                                        </div>

                                        
                                    </div>
                                @endforeach
                            @else
                                <p>No Product Found!</p>
                            @endif
                        </div>
                    </div>
                    {{$products->appends($_GET)->links('vendor.pagination.custom')}}

                    

                </div>
                </form>

            
        
    </section>


    <!-- try diffrent something -->



    <!-- Best Rated/Onsale/Top Sale Product Area -->
    <section class="best_rated_onsale_top_sellares section_padding_100" style="margin-right: 10px; margin-left: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tabs_area">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-tab">
                            <li class="nav-item">
                                <a href="#top-sellers" class="nav-link" data-toggle="tab" role="tab">Top Selling Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="#best-rated" class="nav-link" data-toggle="tab" role="tab">Best Rated</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="top-sellers">
                                <div class="top_sellers_area">
                                    <div class="row">
                                        @foreach($best_sellings as $item)
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_top_sellers">
                                                    <div class="top_seller_image">
                                                    @php
                                                        $photo = explode(',',$item->photo)

                                                    @endphp
                                                        <img src="{{asset($photo[0])}}" alt="{{$item->title}}">
                                                    </div>
                                                    <div class="top_seller_desc">
                                                        <h5>{{ucfirst($item->title)}}</h5>
                                                        <h6>{{Helper::currency_converter($item->offer_price)}} <span>{{Helper::currency_converter($item->price)}}</span></h6>
                                                        <div class="top_seller_product_rating">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>

                                                        <!-- Info -->
                                                        <div class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                            <!-- Add to cart -->
                                                            <div class="ts_product_add_to_cart">
                                                                <a href="javascript:;" data-quantity="1" data-product-id="{{$item->id}}" class="add_to_cart" id="add_to_cart{{$item->id}}"><i class="icofont-shopping-cart"></i></a>
                                                            </div>

                                                            <!-- Wishlist -->
                                                            <div class="ts_product_wishlist">
                                                                <a href="javascript:;"class="add_to_wishlist" data-id="{{$item->id}}" data-quantity="1" id="add_to_wishlist_{{$item->id}}"><i class="icofont-heart"></i></a>
                                                            </div>

                                                            <!-- Compare -->
                                                            <div class="ts_product_compare">
                                                                <a href="javascript:;" class="add_to_compare" data-id="{{$item->id}}" id="add_to_compare_{{$item->id}}"><i class="icofont-exchange"></i></a>
                                                            </div>

                                                            <!-- Quick View -->
                                                            <div class="ts_product_quick_view">
                                                                <a href="#" data-toggle="modal" data-target="#quickview{{$item->id}}"><i class="icofont-eye-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="best-rated">
                                <div class="best_rated_area">
                                    <div class="row">
                                        @foreach($best_rated as $item)
                                        <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_top_sellers">
                                                    <div class="top_seller_image">
                                                    @php
                                                        $photo = explode(',',$item->photo)

                                                    @endphp
                                                        <img src="{{asset($photo[0])}}" alt="{{$item->title}}">
                                                    </div>
                                                    <div class="top_seller_desc">
                                                        <h5>{{ucfirst($item->title)}}</h5>
                                                        <h6>{{Helper::currency_converter($item->offer_price)}} <span>{{Helper::currency_converter($item->price)}}</span></h6>
                                                        <div class="top_seller_product_rating">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>

                                                        <!-- Info -->
                                                        <div class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                            <!-- Add to cart -->
                                                            <div class="ts_product_add_to_cart">
                                                                <a href="javascript:;" data-quantity="1" data-product-id="{{$item->id}}" class="add_to_cart" id="add_to_cart{{$item->id}}"><i class="icofont-shopping-cart"></i></a>
                                                            </div>

                                                            <!-- Wishlist -->
                                                            <div class="ts_product_wishlist">
                                                                <a href="javascript:;"class="add_to_wishlist" data-id="{{$item->id}}" data-quantity="1" id="add_to_wishlist_{{$item->id}}"><i class="icofont-heart"></i></a>
                                                            </div>

                                                            <!-- Compare -->
                                                            <div class="ts_product_compare">
                                                                <a href="javascript:;" class="add_to_compare" data-id="{{$item->id}}" id="add_to_compare_{{$item->id}}"><i class="icofont-exchange"></i></a>
                                                            </div>

                                                            <!-- Quick View -->
                                                            <div class="ts_product_quick_view">
                                                                <a href="#" data-toggle="modal" data-target="#quickview{{$item->id}}"><i class="icofont-eye-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Best Rated/Onsale/Top Sale Product Area -->

    

    <!-- Popular Brands Area -->
    @if(count($brands)>0)
    <section class="popular_brands_area section_padding_50" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular_section_heading mb-50">
                        <h5>Popular Brands</h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="popular_brands_slide owl-carousel">
                        @foreach($brands as $item)
                        <div class="single_brands">
                            <img src="{{asset($item->photo)}}" alt="{{$item->title}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Popular Brands Area -->

@endsection

@section('js')
<!-- <script>
        $(document).on('click','.add_to_cart',function(e){
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quantity');
            //alert(product_qty);
            var token = "{{csrf_token()}}";
            var path  = "{{route('cart.store')}}";

            $.ajax({
                url:path,
                type:"POST",
                dataType:"JSON",
                data:{
                    product_id:product_id,
                    product_qty:product_qty,
                    _token:token,
                },
                beforesend:function(){
                    $('#add_to_cart'+product_id).html('<i class="fa fa-spinner fa-spin"></i> Loading....');
                },
                complete:function(){
                    $('#add_to_cart'+product_id).html('<i class="fa fa-cart-plus"></i> Add to Cart');
                },
                success:function(data){
                    console.log(data);
                    
                    

                    if(data['status']){
                        //for no refresh for update cart value
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_counter']);

                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "Ok!",
                            });
                    }
                },
                error:function(err){
                    console.log(err);
                }
            });
        });
</script> -->

<!-- add to wishlist -->
<!-- <script>
        $(document).on('click','.add_to_wishlist',function(e){
            e.preventDefault();
            var product_id = $(this).data('id');
            var product_qty = $(this).data('quantity');
            //alert(product_qty);
            var token = "{{csrf_token()}}";
            var path  = "{{route('wishlist.store')}}";

            $.ajax({
                url:path,
                type:"POST",
                dataType:"JSON",
                data:{
                    product_id:product_id,
                    product_qty:product_qty,
                    _token:token,
                },
                beforesend:function(){
                    $('#add_to_wishlist_'+product_id).html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete:function(){
                    $('#add_to_wishlist_'+product_id).html('<i class="fas fa-heart"></i>Add to Cart');
                },
                success:function(data){
                    console.log(data);

                        if(data['status']){
                                //for no refresh for update cart value
                             $('body #header-ajax').html(data['header']);
                            $('body #wishlist-counter').html(data['wishlist_count']);
                                swal({
                                    title: "Good job!",
                                    text: data['message'],
                                    icon: "success",
                                    button: "Ok!",
                                    });
                        }
                        else if(data['present']){
                            //for no refresh for update cart value
                            $('body #header-ajax').html(data['header']);
                            $('body #wishlist-counter').html(data['wishlist_count']);
                            swal({
                                title: "opps!",
                                text: data['message'],
                                icon: "warning",
                                button: "Ok!",
                                });
                        }
                        else{
                            swal({
                                title: "Soory!",
                                text: "You can't add any product ",
                                icon: "error",
                                button: "Ok!",
                                });
                        }
                    
                },
                error:function(err){
                    console.log(err);
                }
            });
        });
    </script> -->
<!-- end wishlist -->

<!-- loader -->
<script>
        function loadmoreData(page){
            $.ajax({
                url:'?page='+page,
                type:'get',
                beforeSend:function(){
                    $('.ajax-load').show();
                },

            })
            .done(function(data){
                if(data.html==''){
                    $('.ajax-load').html('No more Product available');
                    return;
                }
                $('.ajax-load').hide();
                $('#product-data').append(data.html);
            })
            .fail(function(){
                alert('Something went worng! please try again');
            });
        }
        var page = 1;
        $(window).scroll(function(){
            if($(window).scrollTop()+$(window).height()+120>=$(document).height()){
                page ++;
                loadmoreData(page);
            }
        })
    </script>
<!-- loader end -->
@endsection