@extends('layouts.master')

{{-- set page title --}}
@section('title', $product->name)

@section('content')

    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Product</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{ route('index') }}">Home</a> / <span>Product</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <section class="product-detail">
        <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-5">
                <div class="product-thumbnail">
                    <a href="{{ route('product.detail', $product->id) }}"><img
                        src="{{ $product->thumbnail }}" alt="{{ $product->name }}"
                        height="300px" with="300px"></a>

                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-description">
                    <form action="{{ route('cart.add-cart', $product->id) }}" method="POST">
                        @csrf

                        <input type="hidden" name="price_id" value="{{  $product->getPrice()->id }}">
                        {{-- <input type="hidden" name="promotion_id" value="{{ $product->getPromotion()->id }}"> --}}

                        <div class="single-item-body">
                            <p class="single-item-title" style="font-size: 25px">{{$product->name  }}</p>
                            <div class="space20">&nbsp;</div>

                            <p class="single-item-price">
                                    @php
                                        $money = $product->getPrice()->price*(100 - 5)/100;
                                    @endphp
                                    <span>{{ number_format($money)}} VND</span>
                            </p>
                        </div>

                        <div class="clearfix"></div>
                        <div class="space20">&nbsp;</div>
                        <div class="single-item-desc">
                            <p>{{ $product->description}}</p>
                        </div>
                        <div class="space20">&nbsp;</div>
                        <div class="product-quantity">
                            <p>Quantity :
                                <span><input type="number" name="quantity" required></span>
                            </p>
                            {{-- <a class="add-to-cart" type="submit"><i class="fa fa-shopping-cart"></i></a> --}}
                            <button type="submit">Add Cart</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}

        {{-- <div class="col-sm-12"> --}}

            <div class="beta-products-list">
                <h4>Sản phẩm tương tự  </h4>
                <div class="beta-products-details">
                    <p class="pull-left">Tìm thấy {{ count( $product_relates) }}  sản phẩm</p>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    @foreach ( $product_relates as $pr_re)
                    <div class="col-sm-3">
                        <div class="single-item">
                            <div class="single-item-header">
                                <a href="{{ route('product.detail', $pr_re->id) }}"><img
                                    src="{{ $pr_re->thumbnail }}" alt=""
                                    height="250px"></a>
                            </div>
                            <div class="single-item-body">
                                <p class="single-item-title">{{ $pr_re->name }}</p>
                                <p class="single-item-price">
                                    @php
                                    // get 1 price
                                    $get_price = $pr_re->getPrice();
                                    $price = $get_price->price;
                                    // get 1 promotion
                                    // $get_promotion = $pr_re->getPromotion();
                                    // $promotion = $get_promotion->discount;
                                    $promotion = 5;
                                    // money
                                    $money = $price * (100 - $promotion)/100;
                                    @endphp
                                    <span class="flash-del"> {{number_format($price) }} </span>
                                    <span class="flash-sale">{{number_format($money) }}</span>
                                </p>
                            </div>
                            <div class="single-item-caption">
                                <a class="add-to-cart pull-left" href="{{ route('cart.add-cart', $product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                <a class="beta-btn primary" href="{{ route('product.detail', $product->id) }}">Details <i class="fa fa-chevron-right"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div> <!-- .beta-products-list -->

            <div class="space50">&nbsp;</div>
        </div>


    </section>
@endsection

@push('css')

@endpush

@push('js')

@endpush
