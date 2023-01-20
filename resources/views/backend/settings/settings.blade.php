@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Settings</h2>
                       
                    </div>
                </div>
            </div>

            <div class="row clearfix">
            @include('backend.layouts.notification')
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('settings.update')}}" method="post">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label>Project Title</label>
                                    <input type="text" name="title" placeholder=" Title" class="form-control" value="{{$setting->title}}">
                                </div>
                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <input type="text" name="meta_keywords" placeholder=" meta_keywords " class="form-control" value="{{$setting->meta_keywords}}">
                                </div>
                                <div class="form-group">
                                    <label>Footer</label>
                                    <input type="text" name="footer" placeholder=" footer " class="form-control" value="{{$setting->footer}}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea class="form-control" name="meta_description" placeholder="write somthing..." rows="5" cols="30" required>{{$setting->meta_description}}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Logo</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" type="text" name="logo" value="{{$setting->logo}}">
                                                </div>
                                                <img id="holder" style="margin-top:15px;max-height:100px;">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Favicon</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail1" class="form-control" type="text" name="favicon" value="{{$setting->favicon}}">
                                                </div>
                                                <img id="holder1" style="margin-top:15px;max-height:100px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder=" email" class="form-control" value="{{$setting->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="number" name="phone" placeholder=" phone" class="form-control" value="{{$setting->phone}}">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" placeholder=" Address" class="form-control" value="{{$setting->address}}">
                                </div>
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input type="text" name="fax" placeholder=" fax" class="form-control" value="{{$setting->fax}}">
                                </div>
                                <div class="form-group">
                                    <label>Facebook Url</label>
                                    <input type="text" name="facebook_url" placeholder=" facebook_url" class="form-control" value="{{$setting->facebook_url}}">
                                </div>
                                <div class="form-group">
                                    <label>Twitter Url</label>
                                    <input type="text" name="twitter_url" placeholder=" twitter_url" class="form-control" value="{{$setting->twitter_url}}">
                                </div>
                                <div class="form-group">
                                    <label>Linkedin Url</label>
                                    <input type="text" name="linkedin_url" placeholder=" linkedin_url" class="form-control" value="{{$setting->linkedin_url}}">
                                </div>
                                <div class="form-group">
                                    <label>Painterest Url</label>
                                    <input type="text" name="painterest_url" placeholder=" painterest_url" class="form-control" value="{{$setting->painterest_url}}">
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
    $('#lfm1').filemanager('image');

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