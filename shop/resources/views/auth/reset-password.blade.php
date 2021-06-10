{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Reset Password')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Reset Password</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Reset Password</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="login-form">
            <form action="{{ route('password.update') }}" method="post" class="beta-form-checkout">
                @csrf
                {{-- @method('PUT') --}}
                <h6>Đặt lại mật khẩu</h6>
                <div class="space20">&nbsp;</div>
                 <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                @if(Session::has('status'))
                    <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <div class="space20">&nbsp;</div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email', $request->email) }}" required  readonly>
                </div>
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" class="form-control" placeholder="Password" type="password" name="password" required autocomplete="password">
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <label for="password">Confirm Password:</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" type="password" name="confirm-password" required autocomplete="confirm-password">
                </div>
                @error('confirm-password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Khôi phục</button>
                </div>
                <div class="clearfix">
                </div>
            </form>
        </div>

    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@push('css')

   <link rel="stylesheet" href="/css/customers/change-password.css">
   <style>
       .login-form{
    border: 1px solid black;
    padding: 30px 40px;
    border-radius: 5px;

   </style>

}
@endpush

@push('js')


@endpush
