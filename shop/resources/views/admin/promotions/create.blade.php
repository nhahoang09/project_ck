
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
@endpush

@push('js')
    <script src="/backend/js/promotions/promotion-create.js"></script>
@endpush

@section('content')
    <h4>Create promotion of {{$product->name}}</h4>
    
    @include('errors.error')
    
    <form action="{{ route('admin.product.promotion.store',$product->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-5">
            <div class="border p-5">
                <div class="row">
                    <div class="col-6">
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

        <div class="form-group">
            <a href="{{ route('admin.product.promotion.index',$product->id )}}" class="btn btn-secondary">List Promotions</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection
