@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Categories Page')

@section('content')

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="aside-menu">
                        @foreach ($categories as $cate)
                            <li><a href="{{  route('category.search', $cate->id) }}">{{ $cate->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-9">


                    <div class="beta-products-list">
                        @foreach ($category as $item)
                        <h4>{{ $item->name }}</h4>
                        @endforeach
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($products) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach ($products as $product)
                            <div class="col-sm-4">
                                <div class="single-item">
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
                                            @if (!empty($discount))
                                                    @php
                                                        $money = $price * (100 - $discount)/100;
                                                    @endphp
                                                <span class="flash-del"> {{ number_format($price) }} VNĐ </span>
                                                <span class="flash-sale">{{ number_format($money) }} VNĐ</span>
                                            @else
                                                <span class="flash-sale"> {{number_format($price) }} VNĐ</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="ribbon-wrapper">
                                        @if (!empty($discount))
                                            <div class="ribbon sale">Sale</div>
                                        @endif

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

                    <div class="beta-products-list">
                        <h4>Sản phẩm khác</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($products_other) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach ($products_other as $pr)
                            <div class="col-sm-4">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $pr->id) }}"><img
                                            src="{{ $pr->thumbnail }}" alt=""
                                            height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $pr->name }}</p>
                                        <p class="single-item-price">
                                            @php
                                                // get 1 price
                                                $get_price = $pr->getPrice();
                                                $price = $get_price->price;
                                                // get 1 promotion
                                                $currentDate = date('Y-m-d');
                                                //dd( $currentDate);
                                                $get_promotion = $pr->getPromotionLatest($pr->id)->first();
                                                //dd($get_promotions);
                                                $discount = 0;
                                                if (!empty($get_promotion->promotion)&&($get_promotion->promotion->end_date>= $currentDate)) {
                                                    $discount = $get_promotion->promotion->discount;
                                                }
                                                // var_dump($get_promotion);
                                                //var_dump('discount: ' . $discount);
                                                @endphp
                                            @if (!empty($discount))
                                                    @php
                                                        $money = $price * (100 - $discount)/100;
                                                    @endphp
                                                <span class="flash-del"> {{ number_format($price) }} VNĐ </span>
                                                <span class="flash-sale">{{ number_format($money) }} VNĐ</span>
                                            @else
                                                <span class="flash-sale"> {{number_format($price) }} VNĐ</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="ribbon-wrapper">
                                        @if (!empty($discount))
                                            <div class="ribbon sale">Sale</div>
                                        @endif

                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('cart.add-cart', $pr->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{ route('product.detail', $pr->id) }}">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            <div class="space40">&nbsp;</div>
                        </div>
                        <div class="row">{{ $products_other ->links() }}</div>

                    </div> <!-- .beta-products-list -->
                </div>

            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection
