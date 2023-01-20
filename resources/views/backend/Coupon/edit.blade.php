@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Coupons</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Coupons</li>
                            <li class="breadcrumb-item active">Edit Coupon</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('coupon.update',$coupon->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>coupon Code</label>
                                    <input type="text" name="code" placeholder=" eg. happy" class="form-control" value="{{$coupon->code}}"  required>
                                </div>
                                <div class="form-group">
                                    <label>coupon Value</label>
                                    <input type="text" name="value" placeholder=" eg. 10%" class="form-control" value="{{$coupon->value}}"  required>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="">Coupon Type</label>
                                    <select name="type" class="form-control" id="">
                                        <option value="">--Coupon Type --</option>
                                        <option value="fixed" {{$coupon->type=='fixed' ? 'selected' : ''}}> Fixed</option>
                                        <option value="percent" {{$coupon->type=='percent' ? 'selected' : ''}}> Percent</option>
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