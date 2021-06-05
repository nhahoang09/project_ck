
@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Create Promotions')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Promotions Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Create Promotions')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/promotions/promotion-create.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/backend/js/promotions/promotion-create.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-list-product').select2();
        });
    </script>
@endpush

@section('content')

    @include('errors.error')

    <form action="{{ route('admin.promotion.store') }}" method="post" >
        @csrf

        <div class="form-group mb-5">
            <div class="border p-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="">Promotion name </label>
                            <input type="text" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Discount</label>
                            <input type="number" name="discount" class="form-control" placeholder="">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Status</label>
                            <div>
                                <input type="radio" name="status" value="0" id="price-status-0">
                                <label for="price-status-0">Private</label>
                                <input type="radio" name="status" value="1" checked  id="price-status-1">
                                <label for="price-status-1">Public</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="">Begin Date</label>
                            <input type="text" name="begin_date" placeholder="YYYY-mm-dd" class="datepicker form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">End Date</label>
                            <input type="text" name="end_date" placeholder="YYYY-mm-dd" class="datepicker form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="border p-5">
                <div class="mb-2">
                    <label for="">List Product</label>
                    <select name="list_product[]" multiple="multiple" class="form-control select2-list-product">
                        @foreach ($products as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <a href="{{ route('admin.product.index')}}" class="btn btn-secondary">List Promotions</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>

    </form>
@endsection
