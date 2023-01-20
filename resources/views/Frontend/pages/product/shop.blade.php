@extends('Frontend.layouts.master')

@section('content')

    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                        <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">$120.99 <span>$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                        <a href="#">View Full Product Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </form>
                                    <!-- Share -->
                                    <div class="share_wf mt-30">
                                        <p>Share with friends</p>
                                        <div class="_icon">
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Area -->

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop Grid</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_50">
        <div class="container">
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

                            

                            <!-- Single Widget -->
                            <div class="widget price mb-30">
                                <h6 class="widget-title">Filter by Price</h6>
                                <div class="widget-desc">
                                    <div class="slider-range">
                                        <div id="slider-range" data-min="{{Helper::minPrice()}}" data-max="{{Helper::maxPrice()}}" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="{{Helper::minPrice()}}" data-value-max="{{Helper::maxPrice()}}" data-label-result="Price:">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        </div>
                                        <div class="d-flex mt-2">
                                            @if(!empty($_GET['price']))
                                                @php
                                                    $price = explode('-',$_GET['price']);
                                                @endphp
                                            @endif
                                            <input  type="hidden" id="price_range" value="@if(!empty($_GET['price'])) {{$_GET['price']}} @endif" name="price_range">
                                            <input type="text" style="border:0; width:68%;" value="$@if(!empty($_GET['price'])) {{$price[0]}} @else {{Helper::minPrice()}} @endif - $@if(!empty($_GET['price'])) {{$price[1]}} @else {{Helper::maxPrice()}} @endif" id="amount" readonly>
                                            <!-- <div class="range-price">Price: {{Helper::minPrice()}} - {{Helper::maxPrice()}}</div> -->
                                            <button type="submit" class="btn btn-sm btn-primary float-right" style="margin: 12px 0px 12px 0px; height:30px;line-height:22px;">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <!-- Single Widget -->
                            @if(count($brands)>0)
                                <div class="widget brands mb-30">
                                    <h6 class="widget-title">Filter by brands</h6>
                                    <div class="widget-desc">
                                    @if(!empty($_GET['brand']))
                                            @php
                                                $filter_brands = explode(',',$_GET['brand'])
                                            @endphp
                                        @endif
                                        <!-- Single Checkbox -->
                                        @foreach($brands as $brand)
                                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                            <input type="checkbox" @if(!empty($filter_brands) && in_array($brand->slug,$filter_brands)) checked @endif class="custom-control-input" id="{{$brand->slug}}" name="brand[]" value="{{$brand->slug}}" onchange="this.form.submit();">
                                            <label class="custom-control-label" for="{{$brand->slug}}">{{$brand->title}} <span class="text-muted">({{count($brand->products)}})</span></label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            
                           
                               
                            
                        </div>
                    
                </div>

                <div class="col-12 col-sm-7 col-md-8 col-lg-9">
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
                                    <div class="col-9 col-sm-12 col-md-6 col-lg-3">
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
            </div>
        </div>
    </section>

@endsection

@section('js')
<!-- price slider -->
<script>
    $(document).ready(function(){
        if($('#slider-range').length>0){
            const max_value = parseInt($('#slider-range').data('max'));
            const min_value = parseInt($('#slider-range').data('min'));
            
            let price_range = min_value+'-'+max_value;
           
            if($('#price_range').length>0 && $('#price_range').val()){
                price_range=$('#price_range').val().trim();
            }
            let price=price_range.split('-');

            $('#slider-range').slider({
                range:true,
                min:min_value,
                max:max_value,
                values:price,
                slide:function(event,ui){
                    $('#amount').val('$'+ui.values[0]+'-'+'$'+ui.values[1]);
                    $('#price_range').val(ui.values[0]+'-'+ui.values[1]);
                }
            });
            
        }
    });
</script>

@endsection