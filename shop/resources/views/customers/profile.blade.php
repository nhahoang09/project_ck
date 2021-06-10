@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Profile Page')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Profile</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Profile</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(!empty($user))

        <form action="" method="post">
        <div class=" profile ">
            {{-- <div class="border p-5">
                <div class="row" >
                    <div class="col-lg-4 col-lg-offset-4"> --}}
                        <h4>Thông tin tài khoản</h4>
                        <div class="space50">&nbsp;</div>
                        <p>Họ tên: {{ Auth::user()->name }}</p>
                        <div class="space30">&nbsp;</div>
                        <p>Email: {{ Auth::user()->email}}</p>
                        <div class="space30">&nbsp;</div>
                        <p>Địa chỉ: {{ Auth::user()->address }}</p>
                        <div class="space30">&nbsp;</div>
                        <p>Số điện thoại: {{ Auth::user()->phone }}</p>
                        <div class="space30">&nbsp;</div>
                    {{-- </div> --}}
                    {{-- <div class="col-lg-4 col-lg-offset-4"> --}}
                    <div class="text-center">
                        <a href="{{ route('customer.edit-profile') }}" class="btn btn-primary">Cập nhật toài khoản</a>
                        <a href="{{  route('customer.change-password') }}" class="btn btn-danger">Đổi mật khẩu</a>
                    </div>
                    {{-- </div> --}}
                {{-- </div> --}}
                <div class="clearfix"></div>
            {{-- </div> --}}
        </div>
        </form>

        @endif
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@push('css')
    {{-- <link rel="stylesheet" href="/backend/css/orders/order-list.css"> --}}
    <style>
        .profile{
        width: 400px;
        margin: 50px auto;
        border: 1px solid#3276b1;
        padding: 30px 40px;
        border-radius: 5px;
        font-size: 15px;
    }

    </style>
@endpush

@push('js')


@endpush
