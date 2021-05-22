@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Edit Price')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Price Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Edit Price')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/prices/price-edit.css">
@endpush

@push('js')
    <script src="/backend/js/prices/price-edit.js"></script>
@endpush

@section('content')
    <h4>Update price of {{$product->name}}</h4>

    @include('errors.error')

    <form action="{{ route('admin.product.price.update',[$product->id,$price->id] ) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-6">
                <div class="form-group mb-2">
                    <label for="">Price</label>
                    <input type="number" name="price" value="{{ old('price', $price->price) }}" class="form-control" placeholder="">
                </div>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-2">
                    <label for="">Status</label>
                    <div>
                        <input type="radio" name="status" value="0" {{ $price->status==0 ? 'checked' : '' }}>
                        <label for="price-status-0">Private</label>
                        <input type="radio" name="status" value="1" {{ $price->status==1 ? 'checked' : '' }}>
                        <label for="price-status-1">Public</label>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group mb-2">
                    <label for="">Begin Date</label>
                    <input type="text" name="begin_date" value="{{ date('Y-m-d', strtotime($price->begin_date)) }}" placeholder="YYYY-mm-dd" class="datepicker form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="">End Date</label>
                    <input type="text" name="end_date" value=" {{ date('Y-m-d', strtotime($price->end_date)) }}" placeholder="YYYY-mm-dd" class="datepicker form-control">
                </div>
            </div>
        </div>
        

        <div class="form-group">
            <a href="{{ route('admin.product.price.index',$product->id) }}" class="btn btn-secondary">List Price</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
