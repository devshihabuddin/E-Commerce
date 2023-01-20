@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Banners</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Banners</li>
                            <li class="breadcrumb-item active">Form Banner</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('banner.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" placeholder=" Banner Title" class="form-control"  required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Photo</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="photo">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                </div>
                                
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="write somthing..." rows="5" cols="30" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Conditions</label>
                                    <select name="condition" class="form-control" id="">
                                        <option value="banner" {{old('condition')=='banner' ? 'selected' : ''}}> Banner</option>
                                        <option value="promo" {{old('condition')=='promo' ? 'selected' : ''}}> Promot</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="">
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