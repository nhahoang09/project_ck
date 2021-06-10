<table id="product-list" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Fullname</th>
            <th>Date create</th>

            <th colspan="2">Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($orders))
            @foreach ($orders as $key => $order)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if ($order->status == \App\Models\Order::STATUS[0])
                            <div class="alert alert-primary" role="alert">chưa thanh toán</div>
                        @elseif ($order->status == \App\Models\Order::STATUS[1])
                            <div class="alert alert-danger" role="alert">đã thanh toán online</div>
                        @elseif ($order->status == \App\Models\Order::STATUS[2])
                            <div class="alert alert-danger" role="alert">đang đi giao hàng</div>
                        @elseif ($order->status == \App\Models\Order::STATUS[3])
                            <div class="alert alert-danger" role="alert">hủy đơn hàng</div>
                        @else
                            <div class="alert alert-success" role="alert">hoàn thành</div>
                        @endif

                    </td>
                    <td>{{ $order->status }}</td>
                    <td><a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-secondary">Order Detail</a></td>
                    <td><a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-info">Update Status</a></td>
                    <td>
                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure DELETE Order?')" class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{ $orders->appends(request()->input())->links() }}
