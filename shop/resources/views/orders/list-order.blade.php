@extends('layouts.master')

{{-- set page title --}}
@section('title', 'History Order Page')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">History Order</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>History Order</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(!empty($orders))
        <div class="table-responsive">
            <!-- Shop Products Table -->
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                    <tr>
                        <th class="product-name" >#</th>
                        <th class="product-name">Order ID</th>
                        <th class="product-price">Status</th>
                        <th class="product-quantity">Detail</th>
                        <th class="product-subtotal">Cancel</th>
                    </tr>


                    @foreach ($orders as $key => $order)
                    <tr class="cart_item">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $order->id }}</td>
                        <td>
                            @if ($order->status == 0)
                                <div class="alert alert-danger" role="alert">chưa thanh toán</div>
                            @elseif ($order->status == 1)
                                <div class="alert alert-danger" role="alert">đã thanh toán online</div>
                            @elseif ($order->status == 2)
                                <div class="alert alert-danger" role="alert">đang đi giao hàng</div>
                            @elseif ($order->status == 3)
                                <div class="alert alert-danger" role="alert">hủy đơn hàng</div>
                            @else
                                <div class="alert alert-success" role="alert">hoàn thành</div>
                            @endif

                        </td>
                        <td><a href="#" class="btn btn-info">Order Detail</a></td>
                        <td><a href="{{ route('order.cancel-order',$order->id) }}" class="btn btn-info">Cancel</a></td>
                    </tr>
                    @endforeach
            </table>
        <div class="clearfix"></div>
        </div>
        @endif

    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@push('css')
    {{-- <link rel="stylesheet" href="/backend/css/orders/order-list.css"> --}}
@endpush

@push('js')
    {{-- <script>
        const URL_CHECKOUT = "{{ route('cart.checkout') }}";
    </script>
    <script src="{{ asset('js/carts/cart-info.js') }}"></script>
    <script>

        $('#basicModal').on('show.bs.modal', function (event) {
                console.log (event);
                console.log ('we are showing');
        /*
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)*/
     })
    </script> --}}


@endpush
