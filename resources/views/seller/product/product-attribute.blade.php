@extends('backend.layouts.master')
@push('css')

@endpush
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Products </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            
                            <li class="breadcrumb-item active">Product Attribute</li>
                        </ul>
                    </div>            
                </div>
            </div>
            
            <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ucfirst($product->title)}}</strong></h2>
                            <div class="row">
                                <div class="col-md-7">
                                    <form action="{{route('product.attribute',$product->id)}}" method="POST">
                                        @csrf
                                        <div id="product-attribute" class="content" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                                            <div class="row">
                                                <div class="col-md-12"><button type="button" id="btnAdd-1" class="btn btn-sm my-2 btn-primary"><i class="icon-plus"></i></button></div>
                                            </div>
                                            <div class="row group">
                                                <div class="col-md-2">
                                                    <label for="">Size</label>
                                                    <input class="form-control form-control-sm" name="size[]" placeholder="eg. S"  type="text" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Original Price</label>
                                                    <input class="form-control form-control-sm" name="original_price[]" placeholder="eg. 2500" step="any" type="number" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Offer Price</label>
                                                    <input class="form-control form-control-sm" name="offer_price[]" placeholder="eg. 200" step="any" type="number" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Stock</label>
                                                    <input class="form-control form-control-sm" name="stock[]" placeholder="eg.4" type="number" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="mt-4 btn btn-danger btnRemove">Remove</button>
                                                </div>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-sm btn-info">Submit</button>
                                    </form>
                                    
                                </div>
                                <div class="col-md-5">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>Original</th>
                                                    <th>Offer</th>
                                                    <th>Stock</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>Original</th>
                                                    <th>Offer</th>
                                                    <th>Stock</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if(count($productattr)>0)

                                                    @foreach($productattr as $key=>$item)

                                                        <tr>
                                                            <td>{{$item->size}}</td>
                                                            <td>${{number_format($item->original_price,2)}}</td>
                                                            <td>${{number_format($item->offer_price,2)}}</td>
                                                            <td>{{$item->stock}}</td>
                                                            <td>
                                                                <button type="button" onclick="deleteProductAttribute({{$item->id}})"  class="btn btn-sm btn-outline-danger"><i class="icon-trash"></i></button>
                                                                <form id="delete-form-{{ $item->id}}" action="{{route('product.attribute.destroy',$item->id)}}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </td>
                                                            
                                                        </tr>

                                                    @endforeach



                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
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
           url:"{{route('product.status')}}",
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
<script src="{{asset('backend/assets/js/jquery.multifield.min.js')}}"></script>
<script>
$('#product-attribute').multifield();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteProductAttribute(id){
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