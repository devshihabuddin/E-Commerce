@extends('backend.layouts.master')
@push('css')

@endpush
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Orders</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            
                            <li class="breadcrumb-item active">Orders</li>
                        </ul>
                        <p><h3>Total Orders: {{\App\Models\Order::count()}}</h3></p>
                    </div>            
                </div>
            </div>
            
            <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">S.N</th>
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
                                        @forelse($orders as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->first_name}} {{$item->last_name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->payment_method=='cod' ? 'Cash on Delivery' : $item->payment_method}}</td>
                                                <td>{{ucfirst($item->payment_status)}}</td>
                                                <td>{{number_format($item->total_amount,2)}}</td>
                                                <td>
                                                    @if($item->condition=='pending')
                                                        <span class="badge badge-info">Pending</span>
                                                    @elseif($item->condition=='processing')
                                                        <span class="badge badge-success">Processing</span>
                                                    @elseif($item->condition=='delivered')
                                                        <span class="badge badge-primary">Delivered</span>
                                                    @else
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('order.show',$item->id)}}" data-toggle="tooltip" title="show" class="btn btn-sm btn-outline-info"><i class="icon-eye"></i></a>
                                                    <button type="button" onclick="deleteOrder({{$item->id}})" title="delete"  class="btn btn-sm btn-outline-danger"><i class="icon-trash"></i></button>
                                                    <form id="delete-form-{{ $item->id}}" action="{{route('order.destroy',$item->id)}}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center" >No orders!</td>
                                            </tr>

                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
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