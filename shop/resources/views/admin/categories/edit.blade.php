@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Edit Category')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Category Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Edit Category')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-edit.css">
@endpush

@section('content')
    <h4>Edit Category</h4>



    <form action="{{ route('admin.category.update', $category->id) }}" method="post" class="form-inline" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <label for="">Category Name:</label>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                    <input type="text" id="" name="category_name" value="{{ $category->name }}" class="form-control"
                        value="" title="" placeholder="">

                    @error('category_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

            <p><a href="{{ route('admin.category.index') }}"><button class="btn btn-primary">List Category</button></a></p>
        </div>
    </div>
@endsection
