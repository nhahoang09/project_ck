{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Forgot Password')

@section('content')

@push('css')
<link rel="stylesheet" href="/css/login.css">
@endpush

<div class="container">


<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Quên mật khẩu</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Quên mật khẩu</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

    <div id="content">

        <div class="login-form">
            <form action="{{ route('password.email') }}" method="post" class="beta-form-checkout">
                @csrf
                <h4>Quên mật khẩu</h4>
                <div class="space20">&nbsp;</div>
                <p>Bạn hãy nhập địa chỉ email mà bạn sử dụng.Sau đó kiểm tra hộp thư email để nhận liên kết đặt lại mật khẩu ! </p>
                <div class="space20">&nbsp;</div>
                @if(Session::has('status'))
                    <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <div class="space20">&nbsp;</div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email"  type="email" name="email" :value="" required autofocus>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Khôi phục password</button>
                </div>
                <div class="clearfix">

                </div>
            </form>

        </div>

    </div> <!-- #content -->
</div> <!-- .container -->


@endsection

