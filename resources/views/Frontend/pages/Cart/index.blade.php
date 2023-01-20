@extends('Frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix">
        <div class="container">
            <div class="row justify-content-between" id="cart_list">

                @include('Frontend.layouts._cart-list')
                
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
@endsection

@section('js')



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
                    $('body #cart_counter').html(data['cart_counter']);
                    $('body #cart_list').html(data['cart_list']);

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
<script>
    $(document).on('click','.qty-text',function(){
        var id = $(this).data('id');
       // alert(id);
       var spinner =$(this),input=spinner.closest("div.quantity").find('input[type="number"]');
      // alert(input.val());
      if(input.val()==1){
          return false;
      }
      if(input.val()!=1){
          var newVal =parseFloat(input.val());
          $('#qty-input-'+id).val(newVal);
      }
      var productQuantity =$('#update-cart-'+id).data('product-quantity');
     // alert(productQuantity);
     update_cart(id,productQuantity)
    });
    function update_cart(id,productQuantity){
        var rowId=id;
        var product_qty=$('#qty-input-'+rowId).val();
        var token="{{csrf_token()}}";
        var path="{{route('cart.update')}}";

        $.ajax({
            url:path,
            type:"POST",
            data:{
                _token:token,
                product_qty:product_qty,
                rowId:rowId,
                productQuantity:productQuantity,
            },
            success:function(data){
                console.log(data);
                
                
                if(data['status']){

                    //for no refresh for update cart value
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_counter']);
                    $('body #cart_list').html(data['cart_list']);
                        // swal({
                        //     title: "Good job!",
                        //     text: data['msg'],
                        //     icon: "success",
                        //     button: "Ok!",
                        //     });
                        alert(data['msg']);
                    }
                    else{
                        alert(data['msg']);
                    }
            }
        });

    }
</script>

<script>
    $(document).on('click','.coupon-btn',function(e){
        e.preventDefault();
        var code = $('input[name=code]').val();
        //alert(code);
        $('.coupon-btn').html('<i class="fas fa-spinner fa-spin"></i> Appling...');
        $('#coupon-form').submit();
    })
</script>
@endsection