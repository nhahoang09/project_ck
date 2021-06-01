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
                <th>Quantity</th>
                <th>Money</th>

                <th colspan="5" class="center">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($order_details))
                @foreach ($order_details as $key => $order_detail)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $order_detail->name }}</td>
                        <td>
                            <img src="{{ asset($order_detail->thumbnail) }}" alt="{{ $order_detail->name }}" class="img-fluid" style="width: 40px; height: auto;">
                        </td>
                        <td>{{ $order_detail->price }}</td>
                        <td>{{ $order_detail->quantity }}</td>

                        <td>
                            @php
                                $money =  $order_detail->quantity*$order_detail->price*(100-5)/100;
                                $total+=$money;
                            @endphp
                            {{ $money }}
                        </td>
                        <td>
                            <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back</a>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>


    <div class="cart-totals-row"><span> Total:</span> <span>{{ $total}}</span></div>



@endsection
