<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Uttara , Dhaka 1230</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#"><i>&#2547;</i> BD</a></li>
                @php
                    $customer = Session::get('id');
                @endphp
                @if ($customer != null)
                    <li><a href="{{ url('/customer-logout') }}"><i class="fa fa-user-o"></i> Logout</a></li>
                @else
                    <li><a href="{{ url('/login-check') }}"><i class="fa fa-user-o"></i> Login</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('img/logo.png') }}" alt="" width="236" height="74px">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form action="{{ url('/search') }}" method="GET">
                            <select class="input-select" name="category">
                                <option value="ALL" {{ request('category') == 'ALL' ? 'selected' : '' }}>All
                                    Categories
                                </option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input class="input" id='search_product' name="product" placeholder="Search here" value="{{ request('product')}}">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        @php
                            $cart_array = cardArray();
                        @endphp
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty"><?= count($cart_array) ?></div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    @foreach ($cart_array as $item)
                                        {{-- @php
                                            $img = $item['attributes'][0];
                                        @endphp --}}
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ asset('image/' . $item['attributes'][0]) }}"
                                                    alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">{{ $item['name'] }}</a></h3>
                                                <h4 class="product-price"><span
                                                        class="qty">{{ $item['quantity'] }}x</span>&#2547;{{ $item['price'] }}
                                                </h4>
                                            </div>
                                            <a class="delete" href="{{ url('delete-cart/' . $item['id']) }}"><i
                                                    class="fa fa-close"></i></a>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="cart-summary">
                                    <small><?= count($cart_array) ?> Item(s) selected
                                    </small>
                                    <h5>SUBTOTAL: &#2547;{{ Cart::getTotal() }}</h5>
                                </div>
                                <div class="cart-btns">
                                    {{-- <a href="{{ url('/login-check') }}">View Cart</a> --}}
                                    @if ($customer != null)
                                        <a style="width: 100%; background: #d10024"
                                            href="{{ url('/checkout') }}">Checkout <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    @else
                                        <a style="width: 100%; background: #d10024"
                                            href="{{ url('/login-check') }}">Login <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
