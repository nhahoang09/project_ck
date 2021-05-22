@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Edit Promotion')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Promotion Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Edit Promotion')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/promotions/promotion-edit.css">
@endpush

@push('js')
    <script src="/backend/js/promotions/promotion-edit.js"></script>
@endpush

@section('content')
    <h4>Update promotion of {{$product->name}}</h4>

    @include('errors.error')

    <form action="{{ route('admin.product.promotion.update',[$product->id,$promotion->id] ) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-6">
                <div class="form-group mb-2">
                    <label for="">Discount</label>
                    <input type="number" name="discount" value="{{ old('discount', $promotion->discount) }}" class="form-control" placeholder="">
                </div>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-2">
                    <label for="">Status</label>
                    <div>
                        <input type="radio" name="status" value="0" {{ $promotion->status==0 ? 'checked' : '' }}>
                        <label for="price-status-0">Private</label>
                        <input type="radio" name="status" value="1" {{ $promotion->status==1 ? 'checked' : '' }}>
                        <label for="price-status-1">Public</label>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group mb-2">
                    <label for="">Begin Date</label>
                    <input type="text" name="begin_date" value="{{ date('Y-m-d', strtotime($promotion->begin_date)) }}" placeholder="YYYY-mm-dd" class="datepicker form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="">End Date</label>
                    <input type="text" name="end_date" value=" {{ date('Y-m-d', strtotime($promotion->end_date)) }}" placeholder="YYYY-mm-dd" class="datepicker form-control">
                </div>
            </div>
        </div>
        

        <div class="form-group">
            <a href="{{ route('admin.product.promotion.index',$product->id) }}" class="btn btn-secondary">List Promotion</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
