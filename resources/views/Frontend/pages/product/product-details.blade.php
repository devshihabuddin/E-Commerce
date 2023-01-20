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
                                        <button type="submit" name="addtocart" value="5" class="cart-submit"><i class="icon-basket-loaded"></i> Add to cart</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="#"><i class="icofont-heart"></i></a>
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
                    <h5>Product Details</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Single Product Details Area -->
    <section class="single_product_details_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <!-- Carousel Inner -->
                            
                            <div class="carousel-inner">
                            @php 
                                $photos = explode(',',$product->photo);
                            @endphp
                                @foreach($photos as $key=>$photo)
                                    <div class="carousel-item {{$key==0 ? 'active' : ''}}">
                                        <a class="gallery_img" href="{{$photo}}" title="{{$product->title}}">
                                            <img class="d-block w-100" src="{{$photo}}" alt="{{$product->title}}">
                                        </a>
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Carosel Indicators -->
                            <ol class="carousel-indicators">
                                @php 
                                    $photos = explode(',',$product->photo);
                                @endphp
                                @foreach($photos as $key=>$photo)
                                    <li class="{{$key==0 ? 'active' : ''}}" data-target="#product_details_slider" data-slide-to="{{$key}}" style="background-image: url({{$photo}});">
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Single Product Description -->
                <div class="col-12 col-lg-6">
                    <div class="single_product_desc">
                        <h4 class="title mb-2">{{$product->title}}</h4>
                        <div class="single_product_ratings mb-2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="text-muted">(5 Reviews)</span>
                        </div>
                        <h4 class="price mb-4">{{Helper::currency_converter($product->offer_price)}} <small><del class="text-danger">{{Helper::currency_converter($product->price)}}</del></small></h4>

                        <!-- Overview -->
                        <div class="short_overview mb-4">
                            <h6>Overview</h6>
                            <p>{!!html_entity_decode($product->summary)!!}</p>
                        </div>

                        <!-- Color Option -->
                        <!-- <div class="widget p-0 color mb-3">
                            <h6 class="widget-title">Color</h6>
                            <div class="widget-desc d-flex">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label black" for="customRadio1"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label pink" for="customRadio2"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label red" for="customRadio3"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label purple" for="customRadio4"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label white" for="customRadio5"></label>
                                </div>
                            </div>
                        </div> -->

                        <!-- Size Option -->
                        <div class="widget p-0 size mb-3">
                            <h6 class="widget-title">Size</h6>
                            <div class="widget-desc" style="display: block; width:45%;">
                                @php 
                                    $product_attr =\App\Models\ProductAttribute::where('product_id',$product->id)->get();
                                @endphp
                                <select name="size" id="">
                                    @foreach($product_attr as $size)
                                     <option value="{{$size->size}}">{{$size->size}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Add to Cart Form -->
                        <!-- <form class="cart clearfix my-5 d-flex flex-wrap align-items-center" method="post">
                            <div class="quantity">
                                <input type="number" class="qty-text form-control" id="qty2" step="1" min="1" max="12" name="quantity" value="1">
                            </div>
                            <button type="submit" name="addtocart" value="5" class="btn btn-primary mt-1 mt-md-0 ml-1 ml-md-3">Add to cart</button>
                        </form> -->
                        <div class="cart clearfix my-5 d-flex flex-wrap align-items-center">
                            <a href="#" data-quantity="1" data-product-id="{{$product->id}}" class="add_to_cart" id="add_to_cart{{$product->id}}"><i class="icon-basket-loaded"></i> Add to Cart</a>
                        </div>

                        <!-- Others Info -->
                        <div class="others_info_area mb-3 d-flex flex-wrap">
                            <a href="#" class="add_to_wishlist" data-id="{{$product->id}}" data-quantity="1" id="add_to_wishlist_{{$product->id}}"><i class="icofont-heart"></i> WISHLIST</a>
                            <a class="add_to_compare" href="compare.html"><i class="fa fa-th" aria-hidden="true"></i> COMPARE</a>
                            <a class="share_with_friend" href="#"><i class="fa fa-share" aria-hidden="true"></i> SHARE WITH FRIEND</a>
                        </div>

                        <!-- Size Guide -->
                        <div class="sizeguide">
                            <h6>Size Guide</h6>
                            <div class="size_guide_thumb d-flex">
                                @php
                                    $size_guide = explode(',',$product->size_guide);
                                @endphp
                                @foreach($size_guide as $sg)
                                    <a class="size_guide_img" href="{{$sg}}" style="background-image: url({{$sg}});">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_details_tab section_padding_100_0 clearfix">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-details-tab">
                            <li class="nav-item">
                                <a href="#description" class="nav-link " data-toggle="tab" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a href="#reviews" class="nav-link active" data-toggle="tab" role="tab">Reviews <span class="text-muted">({{\App\Models\ProductReview::where('product_id',$product->id)->count()}})</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">Additional Information</a>
                            </li>
                            <li class="nav-item">
                                <a href="#refund" class="nav-link" data-toggle="tab" role="tab">Return &amp; Cancellation</a>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="description">
                                <div class="description_area">
                                    <h5>Description</h5>
                                    {!! html_entity_decode($product->description) !!}
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade show active" id="reviews">
                            <div class="submit_a_review_area mt-50">
                                    <h4>Submit A Review</h4>
                                    @auth
                                        <form action="{{route('product.review',$product->slug)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <span>Your Ratings</span>
                                                <div class="stars">
                                                    <input type="radio" name="rate" class="star-1" id="star-1" value="1">
                                                    <label class="star-1" for="star-1">1</label>
                                                    <input type="radio" name="rate" class="star-2" id="star-2" value="2">
                                                    <label class="star-2" for="star-2">2</label>
                                                    <input type="radio" name="rate" class="star-3" id="star-3" value="3">
                                                    <label class="star-3" for="star-3">3</label>
                                                    <input type="radio" name="rate" class="star-4" id="star-4" value="4">
                                                    <label class="star-4" for="star-4">4</label>
                                                    <input type="radio" name="rate" class="star-5" id="star-5" value="5">
                                                    <label class="star-5" for="star-5">5</label>
                                                    <span></span>
                                                </div>
                                                @error('rate')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="form-group">
                                                <label for="options">Reason for your rating</label>
                                                <select class="form-control small right py-0 w-100" name="reason" id="options">
                                                    <option value="quality" {{old('reason')=='quality' ? 'selected' : ''}}>Quality</option>
                                                    <option value="value" {{old('reason')=='value' ? 'selected' : ''}}>Value</option>
                                                    <option value="design" {{old('reason')=='design' ? 'selected' : ''}}>Design</option>
                                                    <option value="price" {{old('reason')=='price' ? 'selected' : ''}}>Price</option>
                                                    <option value="others" {{old('reason')=='others' ? 'selected' : ''}}>Others</option>
                                                </select>
                                                @error('reason')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="comments">Comments</label>
                                                <textarea class="form-control" id="comments" name="review" rows="5" data-max-length="150"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit Review</button>
                                        </form>
                                    @else
                                    <p class="py-5">You need to login for writing review.<a href="{{route('user.auth')}}"> Click Here :)</a> to Login</p>

                                    @endauth
                                    
                                </div>
                                <div class="reviews_area">
                                    @php
                                        $reviews = \App\Models\ProductReview::where('product_id',$product->id)->latest()->paginate(10);

                                    @endphp
                                    <ul class="mt-5">
                                        <li>
                                            @if(count($reviews)>0)
                                                @foreach($reviews as $review)
                                                    <div class="single_user_review mb-15">
                                                        <div class="review-rating">
                                                                @for($i=0; $i<5; $i++)
                                                                    @if($review->rate>$i)
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="icon-star" aria-hidden="true"></i>
                                                                    @endif
                                                                @endfor
                                                            <span>for {{$review->reason}}</span>
                                                        </div>
                                                        <div class="review-details">
                                                            <p>by <a href="#">{{\App\Models\User::where('id',$review->user_id)->value('full_name')}}</a> on <span>{{\Carbon\Carbon::parse($review->create_at)->format('d M Y')}}</span></p>
                                                            <p>{{$review->review}}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            {{$reviews->links('vendor.pagination.custom')}}
                                        </li>
                                    </ul>
                                </div>

                                
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="addi-info">
                                <div class="additional_info_area">
                                    <h5>Additional Info</h5>
                                    {!! html_entity_decode($product->additional_info) !!}
                                    </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="refund">
                                <div class="refund_area">
                                    <h6>Return Policy</h6>
                                    {!! html_entity_decode($product->return_cancellation) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Product Details Area End -->

    <!-- Related Products Area -->
    <section class="you_may_like_area section_padding_0_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>You May Also Like</h5>
                    </div>
                </div>
            </div>
            @if(count($product->related_products)>0)

            <div class="row">
                <div class="col-12">
                    <div class="you_make_like_slider owl-carousel">
                        <!-- Single Product -->
                        @foreach($product->related_products as $item)
                            @if($item->id != $product->id)

                            <div class="single-product-area">
                                <div class="product_image">
                                    <!-- Product Image -->
                                    @php 
                                       $photo = explode(',',$item->photo);
                                    @endphp
                                    <img class="normal_img" src="{{$photo[0]}}" alt="{{$item->title}}">

                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>{{$item->conditions}}</span>
                                    </div>

                                    <!-- Wishlist -->
                                    <div class="product_wishlist">
                                        <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                    </div>

                                    <!-- Compare -->
                                    <div class="product_compare">
                                        <a href="compare.html"><i class="icofont-exchange"></i></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product_description">
                                    <!-- Add to cart -->
                                    <div class="product_add_to_cart">
                                        <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
                                    </div>

                                    <p class="brand_name">{{\App\Models\Brand::where('id',$item->brand_id)->value('title')}}</p>
                                    <a href="{{route('product.details',$item->slug)}}">{{ucfirst($item->title)}}</a>
                                    <h6 class="product-price">${{number_format($item->offer_price,2)}} <small><del class="text-danger">${{number_format($item->price,2)}}</del></small></h6>
                                </div>
                            </div>

                            @endif
                        @endforeach
                        <!-- Single Product -->
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- Related Products Area -->

@endsection
@section('css')

<style>
    .nice-select{
        float: none;
    }
    .widget.size .widget-desc li{
        display: block;
    }
    .nice-select.open .list{
        width:100%;
    }
</style>
@endsection

@section('js')
<!-- add to wishlist -->
<script>
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
    </script>
<!-- end wishlist -->

<!-- add to cart -->
<script>
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
</script>
<!-- end add to cart -->
@endsection