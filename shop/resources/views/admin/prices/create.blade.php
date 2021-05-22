
@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Create Prices')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Prices Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Create Prices')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/prices/price-create.css">
@endpush

@push('js')
    <script src="/backend/js/prices/price-create.js"></script>
@endpush

@section('content')
    <h4>Create price of {{$product->name}}</h4>
    
    @include('errors.error')
    
    <form action="{{ route('admin.product.price.store',$product->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-5">
            <div class="border p-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="">
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

        <div class="form-group">
            <a href="{{ route('admin.product.price.index',$product->id )}}" class="btn btn-secondary">List Prices</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection
