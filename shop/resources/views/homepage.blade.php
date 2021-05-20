@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Home Page')

@section('content')

    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Sản phẩm mới</h4>

                            <div class="beta-products-details">
                                <p class="pull-left"> Tìm thấy {{ count($arr_new_products) }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ( $arr_new_products as $new_product)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon sale">Sale</div>
                                        </div>
                                        <div class="single-item-header">
                                            <a href="{{ route('product.detail', $new_product-> id) }}"><img
                                                    src="frontend/image/product/{{ $new_product-> thumbnail }}" alt=""
                                                    height="250px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $new_product-> name }}</p>
                                            <p class="single-item-price">
                                                @php
                                                $prices = $new_product['prices'];
                                                $promotions = $new_product['promotions'];
                                                @endphp
                                                @foreach ($prices as $price)
                                                <span class="flash-del"> {{$price['price'] }} </span>
                                                @endforeach
                                                @foreach ($promotions as $promotion)
                                                @php
                                                $money = $price['price'] * (100 - $promotion['discount'])/100;
                                                @endphp
                                                <span class="flash-sale"> {{ $money}}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{ route('cart.add-cart', $new_product->id) }}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{ route('product.detail', $new_product->id) }}">Details <i
                                                    class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <div class="row">{{ $arr_new_products ->links() }}</div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Tất cả các sản phẩm</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{ count($products) }} sản phẩm </p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach ($products as $product)

                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon sale">Sale</div>
                                        </div>

                                        <div class="single-item-header">
                                            <a href="product.html"><img
                                                    src="frontend/image/product/{{ $product-> thumbnail }}" alt=""
                                                    height="250px"></a>
                                        </div>

                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $product-> name }}</p>
                                            <p class="single-item-price">
                                                @php
                                                $prices = $new_product['prices'];
                                                //$promotions = $new_product['promotions'];
                                                @endphp
                                                @foreach ($prices as $price)
                                                    <span class="flash-del"> {{$price['price'] }} </span>
                                                @endforeach
                                                {{-- @foreach ($promotions as $promotion)
                                                    @php
                                                         $money = $price['price']  * (100 - $promotion['discount'])/100;
                                                    @endphp
                                                    <span class="flash-sale"> {{ $money}}</span>
                                                @endforeach --}}
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="product.html">Details <i
                                                    class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="space40">&nbsp;</div>
                            </div>
                            <div class="row">{{ $products ->links() }}</div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
