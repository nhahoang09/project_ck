@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Create Category')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Category Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Create Category')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-create.css">
@endpush

@section('content')

    <h1 class="text-center">Create Category</h1>
    <!--form search-->
    @include('errors.error')
    <form action="{{ route('admin.category.store') }}" method="POST" class="form-inline" role="form">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <label for="">Category Name:</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                    <input type="text" id="" name="category_name" class="form-control" value="" title=""
                        placeholder="Enter the category name">
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <button type="submit" class="btn btn-primary">Store</button>
                </div>
            </div>
        </div>
    </form>

     <!--create category link-->

     <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <p><a href="{{ route('admin.category.index') }}"><button class="btn btn-primary">List Category</button></a></p>
        </div>
    </div>
@endsection
