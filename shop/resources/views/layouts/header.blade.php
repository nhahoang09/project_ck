
    <div id="header">
        <div class="header-top">
            <div class="container">
                <div class="pull-left auto-width-left">
                    <ul class="top-menu menu-beta l-inline">
                        <li><a href=""><i class="fa fa-home"></i> K47 - Nguyễn Lương Bằng - Liên Chiểu - Đà Nẵng </a>
                        </li>
                        <li><a href=""><i class="fa fa-phone"></i> 0869 115 106</a></li>
                    </ul>
                </div>
                <div class="pull-right auto-width-right">
                    <ul class="top-details menu-beta l-inline">
                        @auth
                            @if(Route::has('login'))
                            <li>
                                <a href="#"> <i  class="fa fa-user"></i>  ({{Auth::user()->name}})<i class="fa fa-angle-down" ></i></a>
                            </li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li class="" >
                                    <a href=""><button class="" style="background-color: #ffffff; " type="submit">Đăng xuất</button></a>
                                </li>
                            </form>
                            @endif
                        @else
                            @if (Route::has('login'))
                                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">Đăng ký</a></li>
                             @endif

                        @endauth
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-top -->
        <div class="header-body">
            <div class="container beta-relative">
                <div class="pull-left">
                    <a href="{{ route('index') }}" id="logo"><img src="frontend/assets/dest/images/logo-cake.png"
                            width="200px" alt=""></a>
                </div>
                <div class="pull-right beta-components space-left ov">
                    <div class="space10">&nbsp;</div>
                    <div class="beta-comp">
                        <form role="search" method="get" id="searchform" action="{{ route('product.search') }}">
                            <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
                            <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                        </form>
                    </div>
                    <div class="beta-comp">
						<div class="cart">

							{{-- <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (Trống) <i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
								<div class="cart-item">
									<div class="media">
										<a class="pull-left" href="#"><img src="assets/dest/images/products/cart/1.png" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">Sample Woman Top</span>
											<span class="cart-item-options">Size: XS; Colar: Navy</span>
											<span class="cart-item-amount">1*<span>$49.50</span></span>
										</div>
									</div>
								</div>

								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">$34.55</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="checkout.html" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div> --}}

                            @php
                                $cartNumber = 0;
                                if (Session::has('carts')) {
                                    foreach (Session::get('carts') as $key => $value) {
                                        $cartNumber += intval($value['quantity']);
                                    }
                                }
                            @endphp
                        <a href="{{ route('cart.cart-info') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                          </svg></i> Giỏ hàng : ({{ $cartNumber }}) sản phẩm </a>
                        {{-- <a href="{{ route('cart.cart-info') }}"><i class="fa fa-shopping-cart"></i> <span class="text">Giỏ hàng: <span class="number">({{ $cartNumber }}) sản phẩm</span></span> --}}
						</div> <!-- .cart -->
					</div>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-body -->
        <div class="header-bottom" style="background-color: #0277b8;">
            <div class="container">
                <a class="visible-xs beta-menu-toggle pull-right" href="#"><span
                        class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
                <div class="visible-xs clearfix"></div>
                <nav class="main-menu">
                    <ul class="l-inline ov">
                        <li><a href="{{ route('index') }}">Trang chủ</a></li>
                        <li><a href="#">Sản phẩm</a>
                            <ul class="sub-menu">
                                @foreach ($categories as $category)
                                    <li><a href="{{  route('category.search', $category->id) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div> <!-- .container -->
        </div> <!-- .header-bottom -->
    </div> <!-- #header -->









