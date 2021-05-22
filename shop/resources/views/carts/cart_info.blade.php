@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Cart Page')

@section('content')
    <section class="list-product">
        @if(!empty($products))
            <table class="table table-bordered table-hover" id="tbl-list-product">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Thumbanil</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Money</th>
                    </tr>
                </thead>

                 <tbody>

                    @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="product-name">
                                {{ $product->name }}
                            </div>
                        </td>
                        <td>
                            <div class="product-thumbnail">
                                <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid">
                            </div>
                        </td>
                        <td>
                            <div class="product-quantity">
                                {{ $product->id }}
                            </div>
                        </td>
                        <td>
                            @foreach ($product->prices as $item)
                              {{ $a = $item->price }}
                            @endforeach
                            <div class="product-price">
                                @php
                                     $price = $a;
                                @endphp

                            </div>


                        </td>

                        @foreach ($product->prices as $price)
                        @foreach ($product->promotions as $promotion)
                        <td>
                            <div class="cart-money">
                                @php
                                    $money = $product->id *($price->price*(100-$promotion->promotion)/100)  ;
                                    echo number_format($money) . ' VND';
                                 @endphp
                            </div>
                        </td>

                    </tr>

                    @endforeach
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{-- tiến hành thanh toán --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-send-code">Tiến hành thanh toán</button>
            </div>
            {{-- @else --}}
            {{-- <p>Chưa có sản phẩm nào trong giỏ hàng. <a href="/">Tiếp tục mua hàng</a></p> --}}
        @endif

    </section>

    {{-- import modal --}}
    {{-- @include('carts.parts.modal_send_code') --}}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/carts/cart-info.css') }}">
@endpush

@push('js')
    {{-- <script>
        const URL_CHECKOUT = "{{ route('cart.checkout') }}";
    </script> --}}
    <script src="{{ asset('js/carts/cart-info.js') }}"></script>
@endpush
