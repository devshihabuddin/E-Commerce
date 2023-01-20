@extends('seller.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
            @include('backend.layouts.notification')
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">eCommerce</li>
                        </ul>
                    </div>            
                    
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{\App\Models\Category::where('status','active')->count()}}<i class="icon-basket-loaded float-right"></i></h3>
                            <span>Total Category</span>                            
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                            <div class="progress-bar" data-transitiongoal="64"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{\App\Models\Product::where('status','active')->count()}} <i class="icon-briefcase float-right"></i></h3>
                            <span>Total Products</span>        
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-green m-b-0">
                            <div class="progress-bar" data-transitiongoal="68"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{\App\Models\User::where('status','active')->count()}}<i class="icon-user-follow float-right"></i></h3>
                            <span>New Customers</span>                    
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-purple m-b-0">
                            <div class="progress-bar" data-transitiongoal="67"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>2,318 <i class="fa fa-dollar float-right"></i></h3>
                            <span>Net Profit</span>       
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                            <div class="progress-bar" data-transitiongoal="89"></div>
                        </div>
                    </div>
                </div>
                
            </div>

            

            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Recent Orders</h2>                           
                            <ul class="header-dropdown">
                                <a href="" class="btn btn-success btn-sm float-right">View All</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">S.N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                                                             
                                            <th>Total</th>
                                            <th>Status</th>  
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->first_name}} {{$item->last_name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->payment_method=='cod' ? 'Cash on Delivery' : $item->payment_method}}</td>
                                                <td>{{ucfirst($item->payment_status)}}</td>
                                                <td>{{number_format($item->total_amount,2)}}</td>
                                                <td>
                                                    @if($item->condition=='pending')
                                                        <span class="badge badge-info">Pending</span>
                                                    @elseif($item->condition=='processing')
                                                        <span class="badge badge-success">Processing</span>
                                                    @elseif($item->condition=='delivered')
                                                        <span class="badge badge-primary">Delivered</span>
                                                    @else
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('order.show',$item->id)}}" data-toggle="tooltip" title="show" class="btn btn-sm btn-outline-info"><i class="icon-eye"></i></a>
                                                    <button type="button" onclick="deleteCategory({{$item->id}})"  class="btn btn-sm btn-outline-danger"><i class="icon-trash"></i></button>
                                                    <form id="delete-form-{{ $item->id}}" action="{{route('coupon.destroy',$item->id)}}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>No orders!</td>
                                            </tr>

                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>New Orders</h2>
                        </div>
                        <div class="body">
                            <table class="table table-hover">
                                <thead class="thead-success">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Customers</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>IPONE-7</td>
                                        <td>
                                            <ul class="list-unstyled team-info margin-0">                                                
                                                <li><img src="../assets/images/xs/avatar1.jpg" title="Avatar" alt="Avatar"></li>
                                                <li><img src="../assets/images/xs/avatar6.jpg" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                        </td>
                                        <td>$ 356</td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>NOKIA-8</td>
                                        <td>
                                            <ul class="list-unstyled team-info margin-0">                                                
                                                <li><img src="../assets/images/xs/avatar1.jpg" title="Avatar" alt="Avatar"></li>                                                
                                                <li><img src="../assets/images/xs/avatar5.jpg" title="Avatar" alt="Avatar"></li>
                                                <li><img src="../assets/images/xs/avatar9.jpg" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                        </td>
                                        <td>$ 542</td>
                                    </tr>
                                    <tr>
                                        <td>01</td>
                                        <td>IPONE-7</td>
                                        <td>
                                            <ul class="list-unstyled team-info margin-0">                                                
                                                <li><img src="../assets/images/xs/avatar5.jpg" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                        </td>
                                        <td>$ 356</td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>NOKIA-8</td>
                                        <td>
                                            <ul class="list-unstyled team-info margin-0">                                                
                                                <li><img src="../assets/images/xs/avatar3.jpg" title="Avatar" alt="Avatar"></li>
                                                <li><img src="../assets/images/xs/avatar2.jpg" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                        </td>
                                        <td>$ 542</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Top Selling Country</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="world-map-markers" class="jvector-map" style="height: 300px"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection