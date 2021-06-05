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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-list-product').select2();
        });
    </script>
    <script src="/backend/js/promotions/promotion-edit.js"></script>

@endpush

@section('content')

    @include('errors.error')

    <form action="{{ route('admin.promotion.update',$promotion->id) }}" method="post" >
        @csrf
        @method('put')

        <div class="form-group mb-5">
            <div class="border p-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="">Promotion name </label>
                            <input type="text" name="name" value="{{ old('name', $promotion->name) }}" class="form-control" placeholder="">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="form-group mb-2">
                            <label for="">Discount</label>
                            <input type="number" name="discount" value="{{ old('discount', $promotion->discount) }}" class="form-control" placeholder="">
                        </div>
                        @error('discount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="form-group mb-2">
                            <label for="">Status</label>
                            <div>
                                <input type="radio" name="status" value="0" id="price-status-0">
                                <label for="price-status-0">Private</label>
                                <input type="radio" name="status" value="1" checked  id="price-status-1">
                                <label for="price-status-1">Public</label>
                            </div>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="">Begin Date</label>
                            <input type="text" name="begin_date" value="{{ date('Y-m-d', strtotime($promotion->begin_date)) }}" placeholder="YYYY-mm-dd" class="datepicker form-control">
                        </div>
                        @error('begin_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group mb-2">
                            <label for="">End Date</label>
                            <input type="text" name="end_date" value=" {{ date('Y-m-d', strtotime($promotion->end_date)) }}" placeholder="YYYY-mm-dd" class="datepicker form-control">
                        </div>
                        @error('end_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                            <option value="{{ $key }}" {{ in_array($key, $listProductPromotion) ? 'selected' :'' }} >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <a href="{{ route('admin.promotion.index') }}" class="btn btn-secondary">List Promotion</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
