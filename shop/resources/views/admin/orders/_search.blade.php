<div class="mb-5 mt-5 border p-3">
    <form action="{{ route('admin.order.index') }} " method="GET">
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="date" placeholder="Date" value="{{ request()->get('date') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-control" name="status">
                <option value=""></option>
                <option value="0" {{request()->get('status')  ? 'checked' : ''}}>chưa thanh toán</option>
                <option value="1" {{request()->get('status')  ? 'checked' : ''}}>đã thanh toán online</option>
                <option value="2" {{request()->get('status') ? 'checked' : ''}}>đang đi giao hàng</option>
                <option value="3" {{ request()->get('status')  ? 'checked' : ''}}>cancel đơn hàng</option>
                <option value="4" {{ request()->get('status')  ? 'checked' : ''}}>hoàn thành</option>
              </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
