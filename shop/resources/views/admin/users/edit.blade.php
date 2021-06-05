@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Active/De-active User')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'User Active/De-active')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Active/De-active User')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/products/product-create.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/products/product-create.js"></script>
@endpush

@section('content')
    <h4>Active/De-active User</h4>

    @include('errors.error')

    <form action="{{ route('admin.user.update',$user->id) }}" method="post" >
        @csrf
        @method('put')
        <div class="form-group mb-2">
            <label for="">Fullname</label>
            <p>{{ $user->name }}</p>
        </div>
        <div class=" form-group mb-5">
            <label for="">Status</label>
            <ul>
                <li>
                    <input type="radio" name="status" id="order-status-0" value="{{ 0 }}"{{ $user->status == 0 ? 'checked' : '' }}>
                    <label  for="order-status-0" >De-active</label>
                </li>
                <li>
                    <input type="radio" name="status" id="order-status-1" value="{{ 1 }}"{{ $user->status == 1 ? 'checked' : '' }}>
                    <label for="order-status-1">Active</label>
                </li>

            </ul>
        </div>
        <div class="form-group mb-">
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">List user</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
@endsection
