<div class="mb-5 mt-5 border p-3">
    <form action="{{ route('admin.customer.index') }}" method="GET">
        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" class="form-control" name="name" placeholder="Customer Name" value="{{ request()->get('name') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="date" placeholder="Date" value="{{ request()->get('date') }}">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
