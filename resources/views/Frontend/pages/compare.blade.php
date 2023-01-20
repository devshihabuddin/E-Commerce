@extends('Frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Compare</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Compare</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Compare Area  -->
    <div class="compare_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="compare-list">
                        <div class="table-responsive" id="compare">
                            
                                @include('Frontend.layouts._compare')
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection

@section('js')
<script>
    $(document).on('click','.move-to-cart',function(e){
        e.preventDefault();
        var rowId =$(this).data('id');
       // alert(rowId);
       var token ="{{csrf_token()}}";
       var path  = "{{route('compare.move.cart')}}";

       $.ajax({
           url:path,
           type:"post",
           data:{
               _token:token,
               rowId:rowId,
           },
           beforeSend:function(){
               $(this).html('<i class="icofont-spinner"></i>');
           },
           success:function(data){
               if(data['status']){
                   $('body #cart_counter').html(data['cart_count']);
                   $('body #wishlist_list').html(data['wishlist_count']);
                   $('body #compare').html(data['compare_count']);
                   $('body #header-ajax').html(data['header']);

                   swal({
                                    title: "Success!",
                                    text: data['message'],
                                    icon: "success",
                                    button: "Ok!",
                                    });
               }
               else{
                swal({
                                    title: "Opps!",
                                    text: "Something went wrong!",
                                    icon: "warning",
                                    button: "Ok!",
                                    });
               }
           },
           error:function(err){
            swal({
                                    title: "Error!",
                                    text: "Some Error",
                                    icon: "error",
                                    button: "Ok!",
                                    });
           }
       });
    });
</script>
<script>
    $(document).on('click','.move-to-wishlist',function(e){
        e.preventDefault();
        var rowId =$(this).data('id');
       // alert(rowId);
       var token ="{{csrf_token()}}";
       var path  = "{{route('compare.move.wishlist')}}";

       $.ajax({
           url:path,
           type:"post",
           data:{
               _token:token,
               rowId:rowId,
           },
           success:function(data){
               if(data['status']){
                   $('body #cart_counter').html(data['cart_count']);
                   $('body #wishlist_list').html(data['wishlist_count']);
                   $('body #compare').html(data['compare_count']);
                   $('body #header-ajax').html(data['header']);

                   swal({
                                    title: "Success!",
                                    text: data['message'],
                                    icon: "success",
                                    button: "Ok!",
                                    });
               }
               else{
                swal({
                                    title: "Opps!",
                                    text: "Something went wrong!",
                                    icon: "warning",
                                    button: "Ok!",
                                    });
               }
           },
           error:function(err){
            swal({
                                    title: "Error!",
                                    text: "Some Error",
                                    icon: "error",
                                    button: "Ok!",
                                    });
           }
       });
    });
</script>
<script>
    $(document).on('click','.delete-compare',function(e){
        e.preventDefault();
        var rowId =$(this).data('id');
       // alert(rowId);
       var token ="{{csrf_token()}}";
       var path  = "{{route('compare.delete')}}";

       $.ajax({
           url:path,
           type:"post",
           data:{
               _token:token,
               rowId:rowId,
           },
           success:function(data){
               if(data['status']){
                   $('body #cart_counter').html(data['cart_count']);
                   $('body #wishlist_list').html(data['wishlist_count']);
                   $('body #compare').html(data['compare_count']);
                   $('body #header-ajax').html(data['header']);

                   swal({
                                    title: "Success!",
                                    text: data['message'],
                                    icon: "success",
                                    button: "Ok!",
                                    });
               }
               else{
                swal({
                                    title: "Opps!",
                                    text: "Something went wrong!",
                                    icon: "warning",
                                    button: "Ok!",
                                    });
               }
           },
           error:function(err){
            swal({
                                    title: "Error!",
                                    text: "Some Error",
                                    icon: "error",
                                    button: "Ok!",
                                    });
           }
       });
    });
</script>
@endsection