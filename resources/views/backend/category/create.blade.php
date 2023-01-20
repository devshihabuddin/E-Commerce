@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('category.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" placeholder=" Category Title" class="form-control" value="{{old('title')}}"  required>
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
                                        <img id="holder" style="margin-top:15px;max-width:350px; max-height:350px;">
                                </div>
                                
                                <div class="form-group">
                                    <label>Summary</label>
                                    <textarea class="form-control" id="description" name="summary" placeholder="write somthing..." rows="5" cols="30" required>{{old('summary')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Is Parent:</label>
                                    <input type="checkbox" name="is_parent" id="is_parent" value="1" checked>Yes
                                </div>
                                <div class="form-group d-none" id="parent_cat_div">
                                <label for="parent_id">Parent Category</label>
                                    <select name="parent_id" class="form-control" id="">
                                        <option value="">-- Parent Category --</option>
                                        @foreach($parent_cats as $pcats)
                                            <option value="{{$pcats->id}}">{{$pcats->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">-- Status --</option>
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
  <script>
      $('#is_parent').change(function(e){
          e.preventDefault();
          var is_checked=$('#is_parent').prop('checked');
          //alert(is_checked);
          if(is_checked){
              $('#parent_cat_div').addClass('d-none');
              $('#parent_cat_div').val('');

          }else{
              $('#parent_cat_div').removeClass('d-none');
          }
      })
  </script>
@endpush