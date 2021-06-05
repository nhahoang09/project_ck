@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Create User')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'User Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Create User')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/products/product-create.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/products/product-create.js"></script>
@endpush

@section('content')
    <h4>Create User</h4>

    @include('errors.error')

    <form action="{{ route('admin.user.store') }}" method="post" >
        @csrf
        <div class="form-group mb-5">
            <label for="">Full Name</label>
            <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" class="form-control">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group mb-5">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password"  class="form-control">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Confirm Password</label>
            <input type="password" name="confirm-password" placeholder="Confirm Password"  class="form-control">
            @error('confirm-password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-group mb-5">
            <label for="">Role</label>
            <div>
                <input type="radio" name="role_id" value="2" checked id="role_shipper-2">
                <label for="role_shipper-2">Shippper</label>
                <input type="radio" name="role_id" value="3"   id="role_other-">
                <label for="role_other-">Other</label>
            </div>
        </div>









        <div class="form-group">
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">List User</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection
