@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit User</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('user.update',$user->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" name="full_name" value="{{$user->full_name}}" placeholder="full_name" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label>User Name:</label>
                                    <input type="text" name="username" value="{{$user->username}}" placeholder="username" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" value="{{$user->email}}" placeholder="abc@gmail.com" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label>Phone:</label>
                                    <input type="number" name="phone" value="{{$user->phone}}" placeholder="+88.." class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label><br>
                                    <textarea name="address" id="" cols="40" rows="3">{{$user->address}}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Photo</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->photo}}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control" id="">
                                        <option value="">-- Role --</option>
                                        <option value="admin"    {{$user->role=='admin' ? 'selected' : ''}}> Admin</option>
                                        <option value="customer" {{$user->role=='customer' ? 'selected' : ''}}> Customer</option>
                                        <option value="vendor"   {{$user->role=='vendor' ? 'selected' : ''}}> Vendor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">-- Status --</option>
                                        <option value="active" {{$user->status=='active' ? 'selected' : ''}}> Active</option>
                                        <option value="inactive" {{$user->status=='inactive' ? 'selected' : ''}}> Inactive</option>
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