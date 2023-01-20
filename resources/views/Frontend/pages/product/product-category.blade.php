@extends('Frontend.layouts.master')

@section('content')


    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{$category->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
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
                        <select id="sortBy" class="small right">
                            <option selected>Default Sort</option>
                            <option value="priceAsc">Price - Lower To Higher</option>
                            <option value="priceDesc">Price - Higher To Lower</option>
                            <option value="titleAsc">Alphabetical Ascending</option>
                            <option value="titleDesc">Alphabetical Descending</option>
                            <option value="discAsc">Discount - Lower To Higher</option>
                            <option value="discDesc">Discount - Higher To Lower</option>
                        </select>
                    </div>

                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center" id="product-data">
                            <!-- Single Product -->
                            @include('Frontend.pages.product.single-product')                         
                        </div>
                    </div>

                    <div class="ajax-load text-center" style="display: none;">
                        <img src="{{asset('frontend/img/loader.gif')}}" style="width: 30%;" alt="">
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

    <script>
        $('#sortBy').change(function(){
            var sort = $('#sortBy').val();
            //alert(sort);
            window.location="{{url(''.$route.'')}}/{{$category->slug}}?sort="+sort;
        });
    </script>
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

<!-- add to cart -->
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
<!-- end add to cart -->

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
@endsection