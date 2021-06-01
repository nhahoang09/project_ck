@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Checkout Page')

@section('content')
    <section class="checkout">
        <div class="row">
            <div class="col-4">
                <h4>Thông tin đơn hàng</h4>
                <div class="border p-2">
                    @if (!empty($products))
                        @foreach ($products as $product)
                            <div class="list-product">
                                <div class="product-detail">
                                    <p>Sản phẩm: {{ $product->name }}</p>
                                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid" height="70px" width="70px">
                                    <p>Đơn giá: {{ number_format($product->getPrice()->price) .'VNĐ' }}</p>
                                    <p>Số lượng: {{$carts[$product->id]['quantity']  }}</p>
                                    <p>Giảm giá 1 sản phẩm: {{number_format(5).'%'  }}</p>
                                    @php
                                        $money = $carts[$product->id]['quantity'] * $product->getPrice()->price*(100-5)/100;
                                        $total+=$money;
                                    @endphp
                                    <p>Thành tiền:{{ $total.' VND' }}</p>
                                </div>
                            </div>
                            <div class="space40">&nbsp;</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-4">
                {{-- thong tin ca nhan --}}
                <h4>Thông tin cá nhân </h4>
                <div class="border p-2">
                    <div class="p-2">
                        <label for="">Fullname</label>
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="p-2">
                        <label for="">Email</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="p-2">
                        <label for="">Phone</label>
                        <p>{{ Auth::user()->phone }}</p>
                    </div>
                    <div class="p-2">
                        <label for="">Address</label>
                        <p>{{ Auth::user()->address }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                {{-- thong tin thanh toan --}}
                <h4>Thông tin thanh toán</h4>
                <div class="border p-2">
                    <form action="{{ route('cart.checkout-complete') }}" method="POST" id="frm-checkout">
                        @csrf
                        <div class="form-group">
                            <input type="radio" value="1" name="payment_type" id="payment-type-1" checked class="payment-type">
                            <label for="payment-type-1">Thanh toán tại nhà</label>
                            <input type="radio" value="2" name="payment_type" id="payment-type-2" class="payment-type">
                            <label for="payment-type-2">Thanh toán bằng Credit Card</label>
                        </div>
                        <div class="form-group" id="payment-info">
                            <div class="border p-2">
                                <div class="form-group mb-2">
                                    <label for="">Credit Card Number</label>
                                    <input type="number" value="" name="cc_number" class="form-control" placeholder="" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Expiration Date</label>
                                    <input type="text" value="" name="cc_expire_date" class="form-control" placeholder="" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Signature/ CVV2 Code</label>
                                    <input type="number" value="" name="cc_cvv" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary" id="btn-checkout" onclick="return confirm('Are you sure checkout your Order?')">Thanh toán</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/carts/checkout.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/carts/checkout.js') }}"></script>
@endpush
