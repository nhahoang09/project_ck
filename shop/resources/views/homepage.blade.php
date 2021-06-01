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
                                <p class="pull-left"> Tìm thấy {{count($new_products) }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ( $new_products as $new_product)
                                <div class="col-sm-3">
                                    <div class="single-item">

                                        <div class="ribbon-wrapper">
                                            <div class="ribbon sale">Sale</div>
                                        </div>
                                        <div class="single-item-header">
                                            <a href="{{ route('product.detail', $new_product-> id) }}"><img
                                                    src="{{ $new_product->thumbnail }}" alt=""
                                                    height="250px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $new_product->name }}</p>
                                            <p class="single-item-price">
                                                @php
                                                // get 1 price
                                                $get_price = $new_product->getPrice();
                                                $price = $get_price->price;
                                                // get 1 promotion
                                                // $get_promotion = $new_product->getPromotion();
                                                // $promotion = $get_promotion->discount;
                                                $promotion =5;
                                                // money
                                                $money = $price * (100 - $promotion)/100;
                                                @endphp
                                                <span class="flash-del"> {{number_format($price) }} </span>
                                                <span class="flash-sale">{{number_format($money) }}</span>
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{ route('cart.add-cart',$new_product->id) }}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{ route('product.detail', $new_product->id) }}">Details <i
                                                    class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="space40">&nbsp;</div>
                                    </div>
                                </div>

                                @endforeach


                            </div>

                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm bán chạy</h4>
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
                                            <a href="{{ route('product.detail', $product->id) }}"><img
                                                    src="{{ $product->thumbnail }}" alt=""
                                                    height="250px"></a>
                                        </div>

                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $product->name }}</p>
                                            <p class="single-item-price">
                                                @php
                                                // get 1 price
                                                $get_price = $product->getPrice();
                                                $price = $get_price->price;
                                                // get 1 promotion
                                                $get_promotion = $product->getPromotion();
                                               //dd($get_promotion);

                                               // dd($promotion);
                                                // money
                                                //$money = $price * (100 -number_format($promotion))/100;

                                                @endphp
                                                <span class="flash-del"> {{number_format($price) }} </span>
                                                <span class="flash-del"> {{$get_promotion}} </span>
                                                <span class="flash-sale">{{number_format($promotion) }}</span>
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{ route('cart.add-cart',$product->id) }}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{ route('product.detail', $product->id) }}">Details <i
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
