@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Checkout Complete Page')

@section('content')


<section class="list-product">
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Checkout Complete</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Checkout complete</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">

        <p>Đặt hàng thành công. Cảm ơn bạn đã tin tưởng chúng tôi! <a style="color: blue" href="{{ route('index') }}">Tiếp tục mua hàng nào !</a></p>

        <div class="clearfix"></div>
    </div> <!-- #content -->
</div> <!-- .container -->

</section>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/carts/cart-info.css') }}">

@endpush

@push('js')

@endpush
