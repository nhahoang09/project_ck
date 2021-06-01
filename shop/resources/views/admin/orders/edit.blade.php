@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Update Order Status')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Order Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Update Order Status')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/orders/order-list.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/orders/order-list.js"></script>
@endpush

@section('content')
    {{-- show message --}}
    @include('errors.error')

    {{-- display form edit order --}}
    <form action="{{ route('admin.order.update', request()->route('id')) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group mb-2">
            <label for="">Fullname</label>
            <p>{{ $order->user->name }}</p>
        </div>
        <div class=" form-group mb-5">
            <label for="">Status</label>
            <ul>
                <li>
                    <input type="radio" name="status" id="order-status-0" value="{{ \App\Models\Order::STATUS[0] }}" {{ $order->status == \App\Models\Order::STATUS[0] ? 'checked' : '' }}>
                    <label for="order-status-0">chưa thanh toán</label>
                </li>
                <li>
                    <input type="radio" name="status" id="order-status-1" value="{{ \App\Models\Order::STATUS[1] }}" {{ $order->status == \App\Models\Order::STATUS[1] ? 'checked' : '' }}>
                    <label for="order-status-1">đã thanh toán online</label>
                </li>
                <li>
                    <input type="radio" name="status" id="order-status-2" value="{{ \App\Models\Order::STATUS[2] }}" {{ $order->status == \App\Models\Order::STATUS[2] ? 'checked' : '' }}>
                    <label for="order-status-2"> đang đi giao hàng</label>
                </li>
                <li>
                    <input type="radio" name="status" id="order-status-3" value="{{ \App\Models\Order::STATUS[3] }}" {{ $order->status == \App\Models\Order::STATUS[3] ? 'checked' : '' }}>
                    <label for="order-status-3">cancel đơn hàng</label>
                </li>
                <li>
                    <input type="radio" name="status" id="order-status-4" value="{{ \App\Models\Order::STATUS[4] }}" {{ $order->status == \App\Models\Order::STATUS[4] ? 'checked' : '' }}>
                    <label for="order-status-4">hoàn thành</label>
                </li>
            </ul>
        </div>
        <div class="form-group mb-">
            <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">List order</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
@endsection
