@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Change Password Page')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Change Password</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Change Password</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(!empty($user))
        {{-- <form action="{{ route('customer.change-password',$user->id) }}" method="post">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">

                        <div class="form-inlinek">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" readonly >
                        </div>
                        <div class="space20">&nbsp;</div>

                        <div class="form-inline">
                            <label for="password">New Password:</label>
                            <input type="text" name="password" id="password" value="" required>
                        </div>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="space20">&nbsp;</div>


                        <div class="form-inline">
                            <label for="password">Confirm Password:</label>
                            <input type="text" name="confirm-password" id="confirm-password" value="" required>
                        </div>
                        @error('confirm-password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="space20">&nbsp;</div>
                    </div>
                    <div class="col-lg-4 col-lg-offset-4 text-center">
                        <button class="btn btn-primary" type="submit">Cập nhật </button>
                    </div>
                </div>
                <div class="clearfix"></div>
        </form> --}}

        <div class="login-form">
            <form action="{{ route('customer.update-password') }}" method="post" class="beta-form-checkout">
                @csrf
                {{-- @method('PUT') --}}
                <h6>Form change password</h6>
                <div class="space20">&nbsp;</div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" required  readonly>
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
                    <button type="submit" class="btn btn-primary btn-block">Cập nhật</button>
                </div>
                <div class="clearfix">
                </div>
            </form>
        </div>
        @endif
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@push('css')

   <link rel="stylesheet" href="/css/customers/change-password.css">
@endpush

@push('js')


@endpush
