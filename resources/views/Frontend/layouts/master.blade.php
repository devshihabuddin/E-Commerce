<!doctype html>
<html lang="en">


<!-- Mirrored from demo.designing-world.com/bigshop-2.3.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 16:00:46 GMT -->
<head>
    @include('Frontend.layouts.head')

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Header Area -->
    <header class="header_area" id="header-ajax">
    @include('Frontend.layouts.header')
    </header>
    <!-- Header Area End -->
    <!-- notification -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('Backend.layouts.notification')
            </div>
        </div>
    </div>
    <!--end notification -->


    @yield('content')

    <!-- Footer Area -->
    @include('Frontend.layouts.footer')
    <!-- Footer Area -->

    @include('Frontend.layouts.script')
    <script>
        $(document).on('click','.cart_delete',function(e){
            e.preventDefault();
            var cart_id = $(this).data('id');
            //alert(cart_id);
            var token = "{{csrf_token()}}";
            var path  = "{{route('cart.delete')}}";

            $.ajax({
                url:path,
                type:"POST",
                dataType:"JSON",
                data:{
                    cart_id:cart_id,
                    _token:token,
                },
                success:function(data){
                    console.log(data);
                    
                    //for no refresh for update cart value
                    $('body #header-ajax').html(data['header']);

                    if(data['status']){
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
    <!-- autosearch -->
    <script>
        $(document).ready(function(){
            var path ="{{route('autosearch')}}";
            $('#search_text').autocomplete({
                source:function(request,response){
                    $.ajax({
                        url:path,
                        dataType:"JSON",
                        data:{
                            term:request.term
                        },
                        success:function(data){
                            response(data);
                        }
                    });
                },
                minLength:1,
            });
        });
    </script>
    <script>
        function currency_change(currency_code){
            $.ajax({
                type:'POST',
                url:"{{route('currency.load')}}",
                data:{
                    currency_code:currency_code,
                    _token:'{{csrf_token()}}',
                },
                success:function(response){
                    if(response['status']){
                        location.reload();
                    }
                    else{
                        alert('server error');
                    }
                }
            })
        }
    </script>

    <!-- add to compare -->
<script>
        $(document).on('click','.add_to_compare',function(e){
            e.preventDefault();
            var product_id = $(this).data('id');
            //alert(product_qty);
            var token = "{{csrf_token()}}";
            var path  = "{{route('compare.store')}}";

            $.ajax({
                url:path,
                type:"POST",
                dataType:"JSON",
                data:{
                    product_id:product_id,
                    _token:token,
                },
                beforesend:function(){
                    $('#add_to_compare_'+product_id).html('<i class="icofont-spinner"></i>');
                },
                complete:function(){
                    $('#add_to_compare_'+product_id).html('<i class="icofont-exchange"></i>');
                },
                success:function(data){
                    console.log(data);

                        if(data['status']){
                                //for no refresh for update cart value
                             $('body #header-ajax').html(data['header']);
                            $('body #compare-counter').html(data['compare_count']);
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
                            $('body #compare-counter').html(data['compare_count']);
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
                                text: data['message'],
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
<!-- end compare -->

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
                    $('#add_to_cart'+product_id).html('<i class="icofont-spinner-alt-1"></i>');
                },
                complete:function(){
                    $('#add_to_cart'+product_id).html('<i class="fa fa-cart-plus"></i>');
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
                    $('#add_to_wishlist_'+product_id).html('<i class="icofont-spinner"></i>');
                },
                complete:function(){
                    $('#add_to_wishlist_'+product_id).html('<i class="icofont-heart"></i>');
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



</body>


<!-- Mirrored from demo.designing-world.com/bigshop-2.3.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 16:00:55 GMT -->
</html>