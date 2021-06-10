@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Detail Order')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Order Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Detail Order')

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
    <h4> Khách hàng :
    </h4>
    {{-- display form edit order --}}
    <table id="product-list" class="table table-striped table-bordered table-hover">
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
                            <img src="{{ asset($order_detail->thumbnail) }}" alt="{{ $order_detail->name }}" class="img-fluid" style="width: 80px; height: 60px;">
                        </td>
                        <td>{{number_format($order_detail->price) .' VNĐ'  }}</td>
                        @php
                            $discount =0;
                        if($order_detail->promotion_id != null){
                            $discount = $order_detail->promotion->discount;
                        }

                        @endphp
                        @if ($discount == 0)
                            <td>{{ 0 . "%" }}</td>
                        @else
                            <td>{{ $discount . "%" }}</td>
                        @endif
                        <td>{{ $order_detail->quantity }}</td>
                        <td>
                            @php
                                $money =  $order_detail->quantity*$order_detail->price*(100 - $discount)/100;
                                $total+=$money;
                            @endphp
                            {{ number_format($money) .' VNĐ'  }}
                        </td>
                        <td>

                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back</a>


    <div class="cart-totals-row"><span> Total:</span> <span> {{ number_format($total) .' VNĐ'  }}</span></div>



@endsection
