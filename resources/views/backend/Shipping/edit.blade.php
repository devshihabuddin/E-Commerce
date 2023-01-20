@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Shipping</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Shipping</li>
                            <li class="breadcrumb-item active">Edit Shipping</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('shipping.update',$shipping->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Shipping Address</label>
                                    <input type="text" name="shipping_address" placeholder=" shipping address" class="form-control" value="{{$shipping->shipping_address}}"  required>
                                </div>
                                <div class="form-group">
                                    <label>Delivery Time</label>
                                    <input type="text" name="delivery_time" placeholder=" delivery time" class="form-control" value="{{$shipping->delivery_time}}"  required>
                                </div>
                                <div class="form-group">
                                    <label>Delivery Charge</label>
                                    <input type="number" step="any" name="delivery_charge" placeholder=" delivery charge" value="{{$shipping->delivery_charge}}" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">-- Status --</option>
                                        <option value="active" {{$shipping->status=='active' ? 'selected' : ''}}> Active</option>
                                        <option value="inactive" {{$shipping->status=='inactive' ? 'selected' : ''}}> Inactive</option>
                                    </select>
                                </div>
                              
                                <br>
                                <input type="submit" class="btn btn-primary" value="Update">
                                <button type="submit" class="btn btn-outline-secondary">Cancle</button>
                            </form>
                        </div>
                    </div>
                </div>
             
            </div>
            
        </div>
    </div>
@endsection
@push('js')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>

<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endpush