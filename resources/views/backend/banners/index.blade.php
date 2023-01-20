@extends('backend.layouts.master')
@push('css')

@endpush
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Banner List
                        <a class="btn btn-sm btn-outline-secondary float-right" href="{{route('banner.create')}}"><b>+create banner</b></a></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{route('admin')}}><i class="icon-home"></i></a></li>                            
                            
                            <li class="breadcrumb-item active">Banner</li>
                        </ul>
                        <p><h3>Total Banners: {{\App\Models\Banner::count()}}</h3></p>
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
                                            <th>descreption</th>
                                            <th>Photo</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>SL No.</th>
                                            <th>Title</th>
                                            <th>descreption</th>
                                            <th>Photo</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($banners as $key=>$banner)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$banner->title}}</td>
                                            <td>{!!($banner->description)!!}</td>
                                            <td>
                                                <img src="{{$banner->photo}}" alt="banner img" style="max-width: 90px; max-height: 90px">
                                            </td>
                                            <td>
                                                @if($banner->condition=='banner')
                                                    <span class="badge badge-success">Banner</span>
                                                @else
                                                    <span class="badge badge-primary">Promo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" name="toogle" value="{{$banner->id}}" data-toggle="switchbutton" {{$banner->status=='active' ?'checked' : ''}} data-onlabel="Active" data-offlabel="Inactive" data-size="small" data-onstyle="success" data-offstyle="danger">
                                            </td>
                                            <td>
                                                <a href="{{route('banner.edit',$banner->id)}}" data-toggle="tooltip" title="edit" class="btn btn-sm btn-outline-info"><i class="icon-note"></i></a>
                                                <button type="button" onclick="deleteBanner({{$banner->id}})"  class="btn btn-sm btn-outline-info"><i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $banner->id}}" action="{{route('banner.destroy',$banner->id)}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                
                                            </td>
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
           url:"{{route('banner.status')}}",
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
    function deleteBanner(id){
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