@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Coupons</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Coupons</li>
                            <li class="breadcrumb-item active">Form Coupon</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('coupon.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>coupon Code</label>
                                    <input type="text" name="code" placeholder=" eg. happy" class="form-control" value="{{old('code')}}"  required>
                                </div>
                                <div class="form-group">
                                    <label>coupon Value</label>
                                    <input type="text" name="value" placeholder=" eg. 10%" class="form-control" value="{{old('value')}}"  required>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="">Coupon Type</label>
                                    <select name="type" class="form-control" id="">
                                        <option value="">--Coupon Type --</option>
                                        <option value="fixed" {{old('type')=='fixed' ? 'selected' : ''}}> Fixed</option>
                                        <option value="percent" {{old('type')=='percent' ? 'selected' : ''}}> Percent</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">--Coupon Status --</option>
                                        <option value="active" {{old('status')=='active' ? 'selected' : ''}}> Active</option>
                                        <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}> Inactive</option>
                                    </select>
                                </div>
                              
                                <br>
                                <input type="submit" class="btn btn-primary" value="Submit">
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