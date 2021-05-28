<h4>Thông tin đơn hàng</h4>
<div class="border p-2">
    @if (!empty($products))
        @foreach ($products as $product)
            <div class="list-product">
                <div class="product-detail">
                    <p>Sản phẩm: {{ $product->name }}</p>
                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid" height="70px" width="70px">
                    <p>Đơn giá: {{ number_format($product->getPrice()->price) .'VNĐ' }}</p>
                    <p>Số lượng: {{$carts[$product->id]['quantity']  }}</p>
                    <p>Giảm giá 1 sản phẩm: {{number_format($product->getPromotion()->discount).'%'  }}</p>
                    @php
                        $money = $carts[$product->id]['quantity'] * $product->getPrice()->price*(100-$product->getPromotion()->discount)/100;
                        $total+=$money;
                    @endphp
                    <p>Thành tiền:{{ number_format($money) . ' VND' }}</p>
                </div>
            </div>
            <div class="space40">&nbsp;</div>
        @endforeach
    @endif
</div>
