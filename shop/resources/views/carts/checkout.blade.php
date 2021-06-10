@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Checkout Page')

@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Checkout page</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Checkout page</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<section class="checkout">

    <form action="{{ route('cart.checkout-complete') }}" method="post"  id="frm-checkout">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <h4>Đặt hàng</h4>
                <div class="space20">&nbsp;</div>

                <div class="form-block">
                    <label for="name">Họ tên</label>
                    <input type="text" id="name" placeholder="Họ tên" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="form-block">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="{{ Auth::user()->email }}" required placeholder="expample@gmail.com">
                </div>

                <div class="form-block">
                    <label for="adress">Địa chỉ</label>
                    <input type="text" id="address" value="{{ Auth::user()->phone }}" placeholder="Street Address" required>
                </div>


                <div class="form-block">
                    <label for="phone">Điện thoại</label>
                    <input type="text" id="phone" value="{{ Auth::user()->address }}" required>
                </div>


            </div>
            <div class="col-sm-6">
                <div class="your-order">
                    <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                    <div class="your-order-body" style="padding: 0px 10px">
                        <div class="your-order-item">
                            <div>
                            <!--  one item	 -->
                                <div class="media">
                                    @if (!empty($products))
                                    @foreach ($products as $product)
                                        <div class="list-product">
                                            <div class="product-detail">
                                                @php
                                                // get 1 price
                                                $get_price = $product->getPrice();
                                                $price = $get_price->price;
                                                // get 1 promotion
                                                $currentDate = date('Y-m-d');
                                                //dd( $currentDate);
                                                $get_promotion = $product->getPromotionLatest($product->id)->first();
                                                //dd($get_promotions);
                                                $discount = 0;
                                                if (!empty($get_promotion->promotion)&&($get_promotion->promotion->end_date>= $currentDate)) {
                                                    $discount = $get_promotion->promotion->discount;
                                                }
                                                // var_dump($get_promotion);
                                                //var_dump('discount: ' . $discount);
                                                @endphp
                                                <p>Sản phẩm: {{ $product->name }}</p>
                                                <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid" height="70px" width="70px">
                                                <p>Đơn giá: {{ number_format($price) .'VNĐ' }}</p>
                                                <p>Số lượng: {{$carts[$product->id]['quantity']  }}</p>
                                                <p>Giảm giá 1 sản phẩm: {{number_format($discount).'%'  }}</p>
                                                @php
                                                    $money = $carts[$product->id]['quantity'] * $price*(100-$discount)/100;
                                                    $total+=$money;
                                                @endphp
                                                <p>Thành tiền:{{ number_format($money).' VND' }}</p>
                                            </div>
                                        </div>
                                        <div class="space40">&nbsp;</div>
                                    @endforeach
                                @endif
                                </div>
                            <!-- end one item -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="your-order-item">
                            <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                            <div class="pull-right"><h5 class="color-black">{{number_format($total).' VND' }}</h5></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                    <div class="your-order-body">
                        <ul class="payment_methods methods">
                            <li class="payment_method_bacs">
                                <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="1" checked="checked" data-order_button_text="">
                                <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                <div class="payment_box payment_method_bacs" style="display: block;">
                                    Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                </div>
                            </li>

                            <li class="payment_method_cheque">
                                <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="0" data-order_button_text="">
                                <label for="payment_method_cheque">Chuyển khoản </label>
                                <div class="payment_box payment_method_cheque" style="display: none;">
                                    Chuyển tiền đến tài khoản sau:
                                    <br>- Số tài khoản: 123 456 789
                                    <br>- Chủ TK: Hoàng Thanh Nhã
                                    <br>- Ngân hàng ABC, Chi nhánh Đà Nẵng
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="text-center">
                        {{-- <a class="beta-btn primary" href="#">Đặt hàng <i class="fa fa-chevron-right"></i></a> --}}
                    <button type="submit" class="btn btn-primary " id="btn-checkout" onclick="return confirm('Are you sure checkout your Order?')">Thanh toán</button>
                    </div>
                </div> <!-- .your-order -->
            </div>
        </div>
    </form>
</div> <!-- #content -->
</div> <!-- .container -->
</section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/carts/checkout.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/carts/checkout.js') }}"></script>
@endpush
