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
                <option value="0"{{request()->get('status') =="0"  ? 'selected' : ''}} >chưa thanh toán</option>
                <option value="1"{{request()->get('status') =="1"  ? 'selected' : ''}} >đã thanh toán online</option>
                <option value="2"{{request()->get('status') =="2"  ? 'selected' : ''}} >đang đi giao hàng</option>
                <option value="3"{{request()->get('status') =="3"  ? 'selected' : ''}} >cancel đơn hàng</option>
                <option value="4"{{request()->get('status') =="4"  ? 'selected' : ''}} >hoàn thành</option>

              </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
