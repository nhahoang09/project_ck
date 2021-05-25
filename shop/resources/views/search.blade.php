@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Search')

@section('content')

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">

                    <div class="beta-products-list">
                        <h4>Tìm kiếm </h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($products) }}  sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach ($products as $product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $product->id) }}"><img
                                            src="{{ $product->thumbnail }}" alt=""
                                            height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $product->name }}</p>
                                        <p class="single-item-price">
                                            {{-- @php
                                            $prices = $product['prices'];
                                            $promotions = $product['promotions'];
                                            @endphp
                                            @foreach ($prices as $price)
                                            <span class="flash-del"> {{$price['price'] }} </span>
                                            @endforeach
                                            @foreach ($promotions as $promotion)
                                            @php
                                            $money = $price['price'] * (100 - $promotion['discount'])/100;
                                            @endphp
                                            <span class="flash-sale"> {{ $money}}</span>
                                            @endforeach --}}
                                            @php
                                            // get 1 price
                                            $get_price = $product->getPrice();
                                            $price = $get_price->price;
                                            // get 1 promotion
                                            $get_promotion = $product->getPromotion();
                                            $promotion = $get_promotion->discount;
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

            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection
