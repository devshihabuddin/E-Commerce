<div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="{{Helper::userDefaultImage()}}" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Welcome,</span>
                    
                    <a href="javascript:void(0);" class="dropdown-toggle user-name"><strong>{{ucfirst(auth('admin')->user()->full_name)}}</strong></a>
                    
                </div>
            </div>
                
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu">                            
                            <li class="active">
                                <a href="{{route('admin')}}"><i class="icon-home"></i> <span>Dashboard</span></a>
                            </li>
                           
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-picture"></i> <span>Banner Management</span></a>
                                <ul>
                                    <li><a href="{{route('banner.index')}}">All Banners</a></li>
                                    <li><a href="{{route('banner.create')}}">Add Banner</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-list"></i> <span>Category Management</span></a>
                                <ul>
                                    <li><a href="{{route('category.index')}}">All Category</a></li>
                                    <li><a href="{{route('category.create')}}">Add Category</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-handbag"></i> <span>Brand Management</span></a>
                                <ul>
                                    <li><a href="{{route('brand.index')}}">All Brand</a></li>
                                    <li><a href="{{route('brand.create')}}">Add Brand</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-briefcase"></i> <span>Products Management</span></a>
                                <ul>
                                    <li><a href="{{route('product.index')}}">All Products</a></li>
                                    <li><a href="{{route('product.create')}}">Add Product</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-plane"></i><span>Shipping Management</span></a>
                                <ul>
                                    <li><a href="{{route('shipping.index')}}">All Shippings</a></li>
                                    <li><a href="{{route('shipping.create')}}">Add Shipping</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-wallet"></i><span>Currency Management</span></a>
                                <ul>
                                    <li><a href="{{route('currency.index')}}">All Currency</a></li>
                                    <li><a href="{{route('currency.create')}}">Add Currency</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('order.index')}}"><i class="icon-screen-tablet"></i> <span>Order Management</span></a>
                                
                            </li>
                            
                            <li>
                                <a href="{{route('seller.index')}}"><i class="icon-users"></i> <span>Seller Management</span></a>
                                
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-check"></i> <span>Cuppon Management</span></a>
                                <ul>
                                    <li><a href="{{route('coupon.index')}}">All Coupon</a></li>
                                    <li><a href="{{route('coupon.create')}}">Add Coupon</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-user"></i> <span>User Management</span></a>
                                <ul>
                                    <li><a href="{{route('user.index')}}">All Users</a></li>
                                    <li><a href="{{route('user.create')}}">Add user</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('about.index')}}"><i class="icon-info"></i> <span>About Us</span></a>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-user"></i> <span>General Setting</span></a>
                                <ul>
                                    <li><a href="{{route('settings')}}">Setting</a></li>
                                    <li><a href="{{route('smtp')}}">SMTP Setting</a></li>
                                </ul>
                            </li>
                            
                    </ul>
                </div>    
            </div>          
        </div>
    </div>