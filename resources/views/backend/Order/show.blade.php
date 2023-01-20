@extends('backend.layouts.master')
@push('css')

@endpush
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
                <div class="col-lg-12">
                    
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Payment Method</th>
                                                <th>Payment Status</th>
                                                                                
                                                <th>Total</th>
                                                <th>Status</th>  
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                                                    <td>{{$order->email}}</td>
                                                    <td>{{$order->payment_method=='cod' ? 'Cash on Delivery' : $order->payment_method}}</td>
                                                    <td>{{ucfirst($order->payment_status)}}</td>
                                                    <td>{{number_format($order->total_amount,2)}}</td>
                                                    <td>
                                                        @if($order->condition=='pending')
                                                            <span class="badge badge-info">Pending</span>
                                                        @elseif($order->condition=='processing')
                                                            <span class="badge badge-success">Processing</span>
                                                        @elseif($order->condition=='delivered')
                                                            <span class="badge badge-primary">Delivered</span>
                                                        @else
                                                            <span class="badge badge-danger">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('order.show',$order->id)}}" data-toggle="tooltip" title="download" class="btn btn-sm btn-outline-info"><i class="icon-printer"></i></a>
                                                        <button type="button" onclick="deleteOrder({{$order->id}})" title="delete" class="btn btn-sm btn-outline-danger"><i class="icon-trash"></i></button>
                                                        <form id="delete-form-{{ $order->id}}" action="{{route('order.destroy',$order->id)}}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </td>
                                                </tr>
                                            
                                        </tbody>
                                    </table>
                                
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Product Image</th>
                                            <th>Product</th>
                                            <th>Quantity</th>                                                                            
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->products as $key=>$item)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td><img src="{{$item->photo}}" style="max-width: 100px;" alt=""></td>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->pivot->quantity}}</td>
                                                <td>${{number_format($item->price,2)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-7">
                                
                            </div>
                            <div class="col-5 border py-3">
                                <p><strong>Subtotal</strong>:${{number_format($order->sub_total,2)}}</p>
                                @if($order->delivery_charge>0)
                                    <p><strong>Shipping Cost</strong>:${{number_format($order->delivery_charge,2)}}</p>
                                @endif
                                @if($order->coupon>0)
                                    <p><strong>Coupon</strong>:${{number_format($order->coupon,2)}}</p>
                                @endif
                                <p><strong>Total</strong>:${{number_format($order->total_amount,2)}}</p>

                                <form action="{{route('order.status',$order->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <strong>Status</strong>
                                    <select name="condition" class="form-control" id="">
                                        <option value="pending" {{$order->condition=='delivered' || $order->condition=='cancelled' ? 'disabled' : ''}} {{$order->condition=='pending' ? 'selected' : ''}}>Pending</option>
                                        <option value="processing" {{$order->condition=='delivered' || $order->condition=='cancelled' ? 'disabled' : ''}} {{$order->condition=='processing' ? 'selected' : ''}}>Processing</option>
                                        <option value="delivered" {{$order->condition=='cancelled' ? 'disabled' : ''}} {{$order->condition=='delivered' ? 'selected' : ''}}>Delivered</option>
                                        <option value="cancelled" {{$order->condition=='delivered' ? 'disabled' : ''}} {{$order->condition=='cancelled' ? 'selected' : ''}}>{{$order->condition}}</option>
                                    </select>
                                    <button class="btn btn-sm btn-success">update</button>
                                </form>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        
                    </div>

                    
                </div>
                
            </div>

         

        </div>
    </div>
@endsection

@push('js')

<script>
    $('input[name=toogle]').change(function(){
        var mode=$(this).prop('checked');
        var id=$(this).val();
       // alert(id);
       $.ajax({
           url:"{{route('coupon.status')}}",
           type:'POST',
           data:{
               _token:'{{csrf_token()}}',
               mode:mode,
               id:id,
           },
           success:function(response){
              // console.log(response.status);
              if(response.status){
                  alert(response.msg);
              }else{
                  alert('Please try again');
              }
           }

       })
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteOrder(id){
        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You want delete this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    event.preventDefault();
    document.getElementById('delete-form-'+id).submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your file is safe :)',
      'error'
    )
  }
})

    }
</script>
@endpush