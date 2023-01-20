@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit AboutUs</h2>
                       
                    </div>
                </div>
            </div>

            <div class="row clearfix">
            @include('backend.layouts.notification')
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('about.update')}}" method="post">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label> Heading</label>
                                    <input type="text" name="heading" placeholder=" Title" class="form-control" value="{{$about->heading}}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control" name="content" placeholder="write somthing..." rows="5" cols="30" required>{{$about->content}}</textarea>
                                </div>
                                
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" type="text" name="image" value="{{$about->image}}">
                                                </div>
                                                <img id="holder" style="margin-top:15px;max-height:100px;">
                                        </div>
                                
                                <div class="form-group">
                                    <label>Year's Of Experience</label>
                                    <input type="number" name="experience" placeholder=" experience" class="form-control" value="{{$about->experience}}">
                                </div>
                                <div class="form-group">
                                    <label>Team Advisor</label>
                                    <input type="number" name="team_advisor" placeholder=" team_advisor" class="form-control" value="{{$about->team_advisor}}">
                                </div>
                                <div class="form-group">
                                    <label>Happy customer</label>
                                    <input type="number" name="happy_customer" placeholder=" happy_customer" class="form-control" value="{{$about->happy_customer}}">
                                </div>
                                <div class="form-group">
                                    <label>Return customer</label>
                                    <input type="number" name="return_customer" placeholder=" return_customer" class="form-control" value="{{$about->return_customer}}">
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