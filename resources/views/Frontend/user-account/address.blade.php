@extends('Frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                        @include('Frontend.user-account.sidebar')
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    {{$user->address}} <br>
                                    {{$user->state}},{{$user->city}} <br>
                                    {{$user->country}} <br>
                                    {{$user->postcode}} <br>
                                    
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAddress">Edit Address</a>
                                <!--Address Modal -->
                                <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background: rgba(0, 0, 0, 0.5);">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <form action="{{route('billing.address',$user->id)}}" method="POST">
                                                @csrf

                                                <div class="modal-body">
                                                    
                                                    <div class="form-group">
                                                        <label for="">Country</label>
                                                        <input type="text" name="country" class="form-control" id="" value="{{$user->country}}" placeholder="eg.Bangladesh">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Postcode</label>
                                                        <input type="number" name="postcode" class="form-control" id="" value="{{$user->postcode}}" placeholder="eg.234">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">State</label>
                                                        <input type="text" name="state" class="form-control" id="" value="{{$user->state}}" placeholder="eg.Dhaka">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">City</label>
                                                        <input type="text" name="city" class="form-control" id="" value="{{$user->city}}" placeholder="eg.Dhaka">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <textarea name="address" class="form-control" id="" cols="30" rows="3" placeholder="eg.Right your address...">{{$user->address}}</textarea>
                                                    </div>
                                                </div>                                                               
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                            
                                            </form>
                                        
                                    </div>
                                 </div>
                                
                                </div>
                                <!-- end address modal -->

                                
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    {{$user->saddress}} <br>
                                    {{$user->sstate}},{{$user->scity}} <br>
                                    {{$user->scountry}} <br>
                                    {{$user->spostcode}} <br>
                                    
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSaddress">Edit Shipping Address</a>
                                <!--shpping Modal -->
                                <div class="modal fade" id="editSaddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background: rgba(0, 0, 0, 0.5);">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Shipping Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <form action="{{route('shipping.address',$user->id)}}" method="POST">
                                                @csrf

                                                <div class="modal-body">
                                                    
                                                    <div class="form-group">
                                                        <label for="">Shipping Country</label>
                                                        <input type="text" name="scountry" class="form-control" id="" value="{{$user->scountry}}" placeholder="eg.Bangladesh">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Postcode</label>
                                                        <input type="number" name="spostcode" class="form-control" id="" value="{{$user->spostcode}}" placeholder="eg.234">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping State</label>
                                                        <input type="text" name="sstate" class="form-control" id="" value="{{$user->sstate}}" placeholder="eg.Dhaka">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping City</label>
                                                        <input type="text" name="scity" class="form-control" id="" value="{{$user->scity}}" placeholder="eg.Dhaka">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Address</label>
                                                        <textarea name="saddress" class="form-control" id="" cols="30" rows="3" placeholder="eg.Right your address...">{{$user->saddress}}</textarea>
                                                    </div>
                                                </div>                                                               
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                            
                                            </form>
                                        
                                    </div>
                                 </div>
                                
                                </div>
                                <!-- end shpping modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
@endsection

@section('css')
    <style>
        .footer_area{
            z-index: -1;
        }
    </style>
@endsection