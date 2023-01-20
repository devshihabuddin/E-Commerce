@extends('seller.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Products</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Product</li>
                            <li class="breadcrumb-item active">Form Product</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{route('seller-product.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{old('title')}}" placeholder=" Product Title" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label>Summary</label>
                                    <textarea class="form-control" id="summary" name="summary"  placeholder="write somthing..." rows="5" cols="30" required>{{old('summary')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control description" id="description" name="description"  placeholder="write somthing..." rows="5" cols="30" required>{{old('description')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" name="stock" value="{{old('stock')}}" placeholder="Stock" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" step="any" name="price" value="{{old('price')}}" placeholder="price" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="number" step="any" name="discount" value="{{old('discount')}}" placeholder="discount" class="form-control"  required>
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
                                    <label>Size Guide</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail1" class="form-control" type="text" name="size_guide">
                                        </div>
                                        <img id="holder1" style="margin-top:15px;max-height:100px;">
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Brands</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">-- Brand --</option>
                                        @foreach(\App\Models\Brand::get() as $brand)
                                            <option value="{{$brand->id}}" {{old('brand_id')==$brand->id ? 'selected' : ''}}>{{ucfirst($brand->title)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select id="cat_id" name="cat_id" class="form-control">
                                        <option value="">-- Category --</option>
                                        @foreach(\App\Models\Category::where('is_parent',1)->get() as $cat)
                                        <option value="{{$cat->id}}" {{old('cat_id')==$cat->id ? 'selected' : ''}}>{{ucfirst($cat->title)}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group d-none" id="child_cat_div">
                                    <label for="">Child Category</label>
                                    <select id="child_cat_id" name="child_cat_id" class="form-control">
                                        <option value="">-- Child Category --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Size</label>
                                    <select name="size" class="form-control" id="">
                                        <option value="">-- Size --</option>
                                        <option value="S" {{old('size')=='S' ? 'selected' : ''}}> Small</option>
                                        <option value="M" {{old('size')=='M' ? 'selected' : ''}}> Medium</option> 
                                        <option value="L" {{old('size')=='L' ? 'selected' : ''}}> Large</option>
                                        <option value="XL" {{old('size')=='XL' ? 'selected' : ''}}> Extra Large</option>


                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Conditions</label>
                                    <select name="conditions" class="form-control" id="">
                                        <option value="">-- Condition --</option>
                                        <option value="new" {{old('conditions')=='new' ? 'selected' : ''}}> New</option>
                                        <option value="popular" {{old('conditions')=='popular' ? 'selected' : ''}}> Popular</option>
                                        <option value="winter" {{old('conditions')=='winter' ? 'selected' : ''}}> Winter</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Added By</label>
                                    <select name="added_by" class="form-control">
                                        <option value="admin" {{old('added_by')=='admin' ? 'selected' : ''}}></option>
                                        @foreach(\App\Models\Seller::orderBy('full_name','ASC')->get() as $item)
                                            <option value="{{$item->id}}" {{old('added_by')== $item->id ? 'selected' : ''}}>{{$item->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Aditional Information</label>
                                    <textarea class="form-control description" id="description" name="additional_info"  placeholder="write somthing..." rows="5" cols="30" required>{{old('additional_info')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Return Cancellation</label>
                                    <textarea class="form-control description" id="description" name="return_cancellation"  placeholder="write somthing..." rows="5" cols="30" required>{{old('return_cancellation')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
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
    $('#lfm,#lfm1').filemanager('image');
</script>

<script>
    $(document).ready(function() {
        $('#summary').summernote();
    });
  </script>
<script>
    $(document).ready(function() {
        $('.description').summernote();
    });
  </script>
  <script>
      $('#cat_id').change(function(){
          var cat_id=$(this).val();
          
          if(cat_id !=null){
              $.ajax({
                  url:"/admin/category/"+cat_id+"/child",
                  type:"POST",
                  data:{
                      _token:"{{csrf_token()}}",
                      cat_id:cat_id,
                  },
                  success:function(response){
                      var html_option="<option value=''>--Child Category--</option>";
                      if(response.status){
                          $('#child_cat_div').removeClass('d-none');
                          $.each(response.data,function(id,title){
                              html_option +="<option value='"+id+"'>"+title+"</option>"

                          });
                      }else{
                          $('#child_cat_div').addClass('d-none');
                      }
                      $('#child_cat_id').html(html_option);
                  }
              });
          }
      });
  </script>
@endpush