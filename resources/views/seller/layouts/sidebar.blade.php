<div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="{{asset('backend/assets/images/user.png')}}" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Welcome,</span>
                    
                    <a href="javascript:void(0);" class=" user-name"><strong>{{ucfirst(auth('seller')->user()->full_name)}}</strong><span> {{auth('seller')->user()->is_verified ? 'Verified' : 'Unverified'}}</span></a>
                    
                </div>
            </div>
                
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu">                            
                            <li class="active">
                                <a href="{{route('seller')}}"><i class="icon-home"></i> <span>Dashboard</span></a>
                            </li>
                            
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-briefcase"></i> <span>Products Management</span></a>
                                <ul>
                                    <li><a href="{{route('seller-product.index')}}">All Products</a></li>
                                    <li><a href="{{route('seller-product.create')}}">Add Product</a></li>
                                </ul>
                            </li>
                            
                            
                    </ul>
                </div>    
            </div>          
        </div>
    </div>