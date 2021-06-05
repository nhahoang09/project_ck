@extends('layouts.master')

{{-- set page title --}}
@section('title', 'Cart Page')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Shopping Cart</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Home</a> / <span>Shopping Cart</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(!empty($products))
        <div class="table-responsive">
            <!-- Shop Products Table -->
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">Product Name</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                    <tr class="cart_item">
                        <td class="product-name">
                            <div class="media">
                                <img class="pull-left" src="{{ $product->thumbnail }}" alt="" height="80px" width ="80px">
                                <div class="media-body">
                                    <p class="font-large table-title">{{ $product->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="product-price">
                            @php
                            // get 1 price
                            $get_price = $product->getPrice();
                            $price = $get_price->price;
                            // get 1 promotion
                            $currentDate = date('Y-m-d');
                            //dd( $currentDate);
                            $get_promotion = $product->getPromotionLatest($product->id)->first();
                            //dd($get_promotions);
                            $discount = 0;
                            if (!empty($get_promotion->promotion)&&($get_promotion->promotion->end_date>= $currentDate)) {
                                $discount = $get_promotion->promotion->discount;
                            }
                            // var_dump($get_promotion);
                            //var_dump('discount: ' . $discount);
                            @endphp
                            @if (!empty($discount))
                                @php
                                    $price = $price * (100 - $discount)/100;
                                @endphp
                                <span class="amount"> {{ number_format($price) }} VND</span>
                            @else
                                <span class="amount"> {{ number_format($price) }} VND</span>
                            @endif
                        </td>
                        <td class="product-quantity">
                            {{-- {{ number_format($carts[$product->id]['quantity']) }} --}}
                            <form action=" {{route('cart.update-cart',$product->id)}}" method="POST">
                                @csrf
                                <div class="cart-plus-minus-button">
                                    {{-- <input type="button" value="-" class="button-minus" data-field="quantity"> --}}
                                    <input class="" style="text-align: center" type="text" id="quantity" name="quantity" value=" {{ $carts[$product->id]['quantity']}}">
                                    {{-- <input type="button" value="+" class="button-plus" data-field="quantity"> --}}
                                </div>
                                <button type="submit" class="beta-btn primary" name="update_cart">Update Cart </button>
                            </form>
                        </td>

                        <td class="product-subtotal">
                            @php
                                $money = $carts[$product->id]['quantity'] * $price;
                                $total+=$money;
                            @endphp
                            <span class="amount">{{ number_format($money) }} VND</span>
                        </td>

                        <td class="product-remove">
                            <a href="{{ route('cart.remove-cart',$product->id) }}" class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6" >
                            <a href="{{ route('index') }}"><button type="button"  class="beta-btn primary" name="">Tiếp tục mua hàng </button></a>
                            {{-- <button type="button" class="beta-btn primary" data-bs-toggle="modal" data-bs-target="#modal-send-code">Check out</button> --}}
                            <a href="#" class="beta-btn primary" data-toggle="modal" data-target="#basicModal">Check out</a>
                            {{-- <a href="{{ route('cart.checkout') }}"><button type="button"  class="beta-btn primary" name=""> Đặt hàng </button></a> --}}
                        </td>
                    </tr>
                </tfoot>
            </table>

            <!-- End of Shop Table Products -->
        </div>
        @else
            <p>Chưa có sản phẩm nào trong giỏ hàng. <a style="color: blue" href="{{ route('index') }}">Tiếp tục mua hàng</a></p>
        @endif
        <!-- Cart Collaterals -->
        <div class="cart-collaterals">
            <div class="cart-totals pull-right" >
                <div class="cart-totals-row"><h5 class="cart-total-title">Cart Totals</h5></div>
                <div class="cart-totals-row"><span>Cart Total:</span> <span>{{ number_format($total)}} VNĐ</span></div>
                <div class="cart-totals-row"><span>Shipping:</span> <span>{{ number_format($ship = $total*0.05)}} VNĐ</span></div>
                <div class="cart-totals-row"><span>Order Total:</span> <span>{{ number_format($total+$ship)}} VNĐ</span></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End of Cart Collaterals -->
        <div class="clearfix"></div>
    </div> <!-- #content -->
</div> <!-- .container -->

    {{-- import modal --}}
    @include('carts.parts.modal_send_code')
    {{-- tesst --}}



@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/carts/cart-info.css') }}">
@endpush

@push('js')
    <script>
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
    </script>



@endpush
