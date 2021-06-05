@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Register')

@section('content')

{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}



<div class="container">
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng ký</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{ route('index') }}">Home</a> / <span>Đăng ký</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div id="content">
        <div class="login-form">
            <form action="{{ route('register') }}" method="post" class="beta-form-checkout">
                @csrf
                {{-- @method('PUT') --}}
                <h4>Đăng ký</h4>
                <div class="space20">&nbsp;</div>
                <div class="form-group">
                    <label for="email">Name:</label>
                    <input type="text" class="form-control" placeholder="Name"  type="" name="name" value="" required autofocus >
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" placeholder="Eamail"  type="email" name="email" :value="old('email')" required autofocus>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" type="password" name="password" required >
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <label for="password">Confirm Password:</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" type="password" name="confirm-password" required >
                </div>
                @error('confirm-password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <label for="email">Address:</label>
                    <input type="text" class="form-control" placeholder="Address"  type="" name="address" value="" required   >
                </div>
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>

                <div class="form-group">
                    <label for="email">Phone:</label>
                    <input type="text" class="form-control" placeholder="Phone"  type="" name="phone" value="" required  >
                </div>
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="space20">&nbsp;</div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <div class="clearfix">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already have an account? Login') }}
                    </a>
                @endif

            </form>
        </div>

    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@push('css')

   <link rel="stylesheet" href="/css/customers/change-password.css">
@endpush

@push('js')


@endpush




