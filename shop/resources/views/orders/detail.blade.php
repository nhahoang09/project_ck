@extends('layouts.master')

{{-- set page title --}}
@section('title', ' Order Detail Page')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title"> Order Detail</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Order Detail</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <h4></h4>

        <div class="table-responsive">
            <!-- Shop Products Table -->
            <table class="shop_table beta-shopping-cart-table">
                <thead class="table-dark ">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Thumbnail</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Money</th>

                    </tr>
                </thead>
                <tbody>
                    @if(!empty($order_details))
                        @foreach ($order_details as $key => $order_detail)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $order_detail->name }}</td>
                                <td>
                                    <img src="{{ asset($order_detail->thumbnail) }}" alt="{{ $order_detail->name }}" class="img-fluid" style="width: 80px; height:60px;">
                                </td>
                                <td>{{ $order_detail->price }}</td>
                                @php
                                $discount = $order_detail->discount;
                                @endphp
                                @if ($discount == null)
                                    <td>{{ 0 . "%" }}</td>
                                @else
                                    <td>{{ $discount . "%" }}</td>
                                @endif
                                <td>{{ $order_detail->quantity }}</td>

                                @php
                                    $money =  $order_detail->quantity*$order_detail->price*(100-$discount)/100;
                                    $total+=$money;
                                @endphp
                                <td>{{ number_format($money) . "VNĐ" }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>



            </table>
            <div class="text-right">
                <h4>Total: {{ number_format($total) .' VNĐ'  }}</h4>
            </div>
            <td>
                <a href="{{ route('order.list-order') }}" class="btn btn-primary">Back</a>
            </td>
        <div class="clearfix"></div>
        </div>

    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@push('css')
    {{-- <link rel="stylesheet" href="/backend/css/orders/order-list.css"> --}}
@endpush

@push('js')


@endpush
