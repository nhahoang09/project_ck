@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Edit Profile Page')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Edit Profile</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Edit Profile</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(!empty($user))
        <form action="{{ route('customer.update-profile',$user->id) }}" method="post">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <div class="form-inline">
                            <label for="name">Họ tên:</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"  required>
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="space20">&nbsp;</div>


                        <div class="form-inlinek">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" required >
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="space20">&nbsp;</div>

                        <div class="form-inline">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" name="address" id="address" value="{{ $user->address }}" required>
                        </div>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="space20">&nbsp;</div>


                        <div class="form-inline">
                            <label for="phone">Điện thoại:</label>
                            <input type="text" name="phone" id="phone"  value="{{ $user->phone }}" required>
                        </div>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="space20">&nbsp;</div>
                    </div>
                    <div class="col-lg-4 col-lg-offset-4 text-center">
                        <button class="btn btn-primary" type="submit">Cập nhật </button>
                    </div>
                </div>
                <div class="clearfix"></div>
        </form>
        @endif
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@push('css')
    {{-- <link rel="stylesheet" href="/backend/css/orders/order-list.css"> --}}
@endpush

@push('js')


@endpush
