@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Checkout Page')

@section('content')
    <section class="checkout">
        <div class="row">
            <div class="col-4">
                {{-- thong tin don hang --}}
                @include('carts.parts.cart_info')
            </div>
            <div class="col-4">
                {{-- thong tin ca nhan --}}
                @include('carts.parts.personal_info')
            </div>
            <div class="col-4">
                {{-- thong tin thanh toan --}}
                @include('carts.parts.payment_info')
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/carts/checkout.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/carts/checkout.js') }}"></script>
@endpush
