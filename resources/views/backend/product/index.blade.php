@extends('backend.layouts.master')
@push('css')

@endpush
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Product List
                        <a class="btn btn-sm btn-outline-secondary float-right" href="{{route('product.create')}}"><b>+create Product</b></a></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            
                            <li class="breadcrumb-item active">Product</li>
                        </ul>
                        <p><h3>Total Products: {{\App\Models\Product::count()}}</h3></p>
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
                                        <th>SL No.</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Size</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>SL No.</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Size</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($products as $key=>$item)

                                        @php
                                            $photo = explode(',',$item->photo);
                                        @endphp
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{Str::limit($item->title,30)}}</td>
                                            <td>
                                                <img src="{{$photo[0]}}" alt="banner img" style="max-width: 90px; max-height: 90px">
                                            </td>
                                            <td>${{number_format($item->price,2)}}</td>
                                            <td>{{$item->discount}}%</td>
                                            <td>{{$item->size}}</td>
                                            <td>
                                                @if($item->conditions=='new')
                                                  <span class="badge badge-success">{{$item->conditions}}</span>
                                                @elseif($item->conditions=='popular')
                                                  <span class="badge badge-warning">{{$item->conditions}}</span>
                                                @else
                                                  <span class="badge badge-primary">{{$item->conditions}}</span>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->status=='active' ?'checked' : ''}} data-onlabel="Active" data-offlabel="Inactive" data-size="small" data-onstyle="success" data-offstyle="danger">
                                            </td>
                                            <td>
                                                <a href="{{route('product.show',$item->id)}}" data-toggle="tooltip" title="add attribute" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#productId{{$item->id}}" data-toggle="tooltip" title="view" class="btn btn-sm btn-outline-info"><i class="icon-eye"></i></a>
                                                <a href="{{route('product.edit',$item->id)}}" data-toggle="tooltip" title="edit" class="btn btn-sm btn-outline-primary"><i class="icon-note"></i></a>
                                                <button type="button" onclick="deleteProduct({{$item->id}})"  class="btn btn-sm btn-outline-danger"><i class="icon-trash"></i></button>
                                                <form id="delete-form-{{ $item->id}}" action="{{route('product.destroy',$item->id)}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                
                                            </td>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="productId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                @php 

                                                $product = \App\Models\Product::where('id',$item->id)->first();

                                                @endphp
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{Illuminate\Support\Str::upper($product->title)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <strong>Summary:</strong>
                                                    <p>{!! html_entity_decode($product->summary) !!}</p>

                                                    <strong>Description:</strong>
                                                    <p>{!! html_entity_decode($product->description) !!}</p>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <strong>Price:</strong>
                                                            <p>${{number_format($product->price,2)}}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Discount:</strong>
                                                            <p>{{$product->discount}}%</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Vendor:</strong>
                                                            <p>{{\App\Models\User::where('id',$product->vendor_id)->value('full_name')}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Offer_Price:</strong>
                                                            <p>${{number_format($product->offer_price,2)}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Category:</strong>
                                                            <p>{{\App\Models\Category::where('id',$product->cat_id)->value('title')}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Child_Category:</strong>
                                                            <p>{{\App\Models\Category::where('id',$product->child_cat_id)->value('title')}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Brand:</strong>
                                                            <p>{{\App\Models\Brand::where('id',$product->brand_id)->value('title')}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Size:</strong>
                                                            <p class="badge badge-info">{{$product->size}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Conditions:</strong>
                                                            <p class="badge badge-success">{{$product->conditions}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Status</strong>
                                                            <p class="badge badge-warning">{{$product->status}}</p> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Stock:</strong>
                                                            <p>{{number_format($product->stock)}}</p> 
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!--End Modal -->
                                        </tr>
                                        @endforeach
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteProduct(id){
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