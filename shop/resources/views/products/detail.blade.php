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
                        src="frontend/image/product/{{ $product->thumbnail }}" alt="{{ $product->name }}"
                        height="250px"></a>

                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-description">
                    <form action="{{ route('cart.add-cart', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="price_id" value="">

                        <div class="single-item-body">
                            <p class="single-item-title" style="font-size: 25px">{{$product->name  }}</p>
                            <div class="space20">&nbsp;</div>

                            <p class="single-item-price">
                                @foreach ($product->prices as $price)
                                @foreach ($product->promotions as $promotion)
                                    @php
                                        $money =  $price->price*(100 - $promotion->discount)/100;
                                    @endphp
                                    <span>{{ number_format($money)}} VND</span>

                                @endforeach

                                @endforeach
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
                            <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('css')

@endpush

@push('js')

@endpush
