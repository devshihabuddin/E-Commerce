
        <!-- Top Header Area -->
        <div class="top-header-area" style="background-color: #00586D;">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-6">
                        <div class="welcome-note"  style="margin-left: 280px;">
                            <span class="popover--text" data-toggle="popover" data-content="Welcome to Bigshop ecommerce template."><i class="icofont-info-square"></i></span>
                            <span class="text" style="color:#FFFFFF">Welcome to {{\App\Models\Setting::value('title')}}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
                            
                            <!-- <div class="language-dropdown">
                                <div class="dropdown">
                                    
                                    <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        English
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <a class="dropdown-item" href="#">Bangla</a>
                                        <a class="dropdown-item" href="#">Arabic</a>
                                    </div>
                                </div>
                            </div> -->

                            
                            <div class="currency-dropdown">
                                <div class="dropdown">
                                    @php
                                        Helper::currency_load();
                                        $currency_code = session('currency_code');
                                        $currency_symbol = session('currency_symbol');

                                        if($currency_symbol==""){
                                            $system_default_currency_info = session('system_default_currency_info');
                                            $currency_symbol = $system_default_currency_info->symbol;
                                            $currency_code = $system_default_currency_info->code;
                                        }

                                    @endphp
                                    <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         <span style="color:#FFFFFF">{{$currency_symbol}} {{$currency_code}}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                        @foreach(\App\Models\Currency::where('status','active')->get() as $currency)
                                        <a class="dropdown-item" href="#" onclick="currency_change('{{$currency['code']}}');">{{$currency->symbol}} {{\Illuminate\Support\Str::upper($currency->name)}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Menu -->
        
                    <nav class="classy-navbar" style="background-color: #000000;" id="bigshopNav" >

                        <!-- Nav Brand -->
                        <a href="{{route('front.home')}}" class="nav-brand"><img src="{{asset(get_setting('logo'))}}" alt="logo" style="margin-left: 30px;"></a>

                        <!-- Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Close -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="{{route('front.home')}}"><span style="color:#FFFFFF">Home</span></a>
                                    </li>
                                    <li><a href="{{route('shop')}}"><span style="color:#FFFFFF">Shop</span></a>
                                    </li>
                                    <li><a href="{{route('about.us')}}"><span style="color:#FFFFFF">About Us</span></a>
                                    </li>
                                    <li><a href="{{route('contact.us')}}"><span style="color:#FFFFFF">Contact Us</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Hero Meta -->
                        <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                            <!-- Search -->
                            <div class="search-area">
                                <div class="search-btn"><i class="icofont-search"></i></div>
                                <!-- Form -->
                                <form action="{{route('search')}}" method="GET">
                                    <div class="search-form">
                                        <input type="search" id="search_text" name="query" class="form-control" placeholder="Search">
                                        <input type="submit" class="d-none" value="Send">
                                    </div>
                                </form>
                            </div>

                            <!-- Wishlist -->
                            <div class="wishlist-area">

                                <a href="{{route('wishlist')}}" class="wishlist-btn"><i class="icofont-heart"></i></a>
                            </div>

                            <!-- Compare -->
                            <div class="cart-area">
                                <div class="cart--btn"><a href="{{route('compare')}}"><i class="icofont-exchange"></i></a> <span class="cart_quantity" id="compare-counter">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->count()}}</span></div>

                                <!-- Cart Dropdown Content -->
                                <div class="cart-dropdown-content">
                                    <ul class="cart-list">
                                        @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                                            <li>
                                                <div class="cart-item-desc">
                                                    <a href="#" class="image">
                                                        <img src="{{$item->model->photo}}" class="cart-thumb" alt="">
                                                    </a>
                                                    <div>
                                                        <a href="{{route('product.details',$item->model->slug)}}">{{$item->name}}</a>
                                                        <p>{{$item->qty}} x-<span class="price">{{number_format($item->price,2)}}</span></p>
                                                    </div>
                                                </div>
                                                <span class="dropdown-product-remove cart_delete" data-id="{{$item->rowId}}"><i class="icofont-bin"></i></span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="cart-pricing my-4">
                                        <ul>
                                            <li>
                                                <span>Sub Total:</span>
                                                <span>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</span>
                                            </li>
                                            <!-- <li>
                                                <span>Shipping:</span>
                                                <span>$</span>
                                            </li> -->
                                            <li>
                                                <span>Total:</span>
                                                @if(session()->has('coupon'))
                                                    <span>${{number_format((float) Str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal())-\Illuminate\Support\Facades\Session::get('coupon')['value'],2)}}</span>
                                                @else
                                                    <span>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cart-box d-flex">
                                        <a href="{{route('cart')}}" class="btn btn-success d-block">Cart</a>
                                        <a href="{{route('checkout1')}}" class="btn btn-primary d-block">Checkout</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Cart -->
                            <div class="cart-area">
                                <div class="cart--btn"><i class="icofont-cart"></i> <span class="cart_quantity">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count()}}</span></div>

                                <!-- Cart Dropdown Content -->
                                <div class="cart-dropdown-content">
                                    <ul class="cart-list">
                                        @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                            <li>
                                                <div class="cart-item-desc">
                                                    <a href="#" class="image">
                                                        <img src="{{$item->model->photo}}" class="cart-thumb" alt="">
                                                    </a>
                                                    <div>
                                                        <a href="{{route('product.details',$item->model->slug)}}">{{$item->name}}</a>
                                                        <p>{{$item->qty}} x-<span class="price">{{Helper::currency_converter($item->price)}}</span></p>
                                                    </div>
                                                </div>
                                                <span class="dropdown-product-remove cart_delete" data-id="{{$item->rowId}}"><i class="icofont-bin"></i></span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="cart-pricing my-4">
                                        <ul>
                                            <li>
                                                <span>Sub Total:</span>
                                                <span>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</span>
                                            </li>
                                            <!-- <li>
                                                <span>Shipping:</span>
                                                <span>$</span>
                                            </li> -->
                                            <li>
                                                <span>Total:</span>
                                                @if(session()->has('coupon'))
                                                    <span>${{number_format((float) Str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal())-\Illuminate\Support\Facades\Session::get('coupon')['value'],2)}}</span>
                                                @else
                                                    <span>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cart-box d-flex">
                                        <a href="{{route('cart')}}" class="btn btn-success d-block">Cart</a>
                                        <a href="{{route('checkout1')}}" class="btn btn-primary d-block">Checkout</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Account -->
                            <div class="account-area">
                                <div class="user-thumbnail"  style="margin-right: 20px;">
                                    @auth
                                        @if(auth()->user()->photo)
                                            <img src="{{auth()->user()->photo}}" alt="">
                                        @else
                                            <img src="{{Helper::userDefaultImage()}}" alt="">                               
                                        @endif
                                    @else
                                        <img src="{{Helper::userDefaultImage()}}" alt="">
                                    @endauth
                                </div>
                                <ul class="user-meta-dropdown">
                                    @auth()
                                    @php
                                        $first_name =explode(' ',auth()->user()->full_name);
                                    @endphp
                                    <li class="user-title"><span>Hello,</span> {{$first_name[0]}}</li>
                                    <li><a href="{{route('user.dashboard')}}">My Account</a></li>
                                    <li><a href="{{route('user.order')}}">Orders List</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="{{route('user.logout')}}"><i class="icofont-logout"></i> Logout</a></li>
                                    @else
                                        <li><a href="{{route('user.auth')}}"><strong>Login & Register</strong></a></li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </nav>