@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Edit Product')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Product Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Edit Product')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/products/product-edit.css">
@endpush

@section('content')
    <h4>Update product</h4>

    @include('errors.error')

    <form action="{{ route('admin.product.update', request()->route('id')) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group mb-5">
            <label for="">Product Name</label>
            <input type="text" name="name" placeholder="product name" value="{{ old('name', $product->name) }}" class="form-control">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

         <div class="form-group mb-5">
            <label for="">Category</label>
            <select name="category_id" class="form-control">
                <option value=""></option>
                @if(!empty($categories))
                    @foreach ($categories as $categoryId => $categoryName)
                        <option value="{{ $categoryId }}" {{ old('category_id', $product->category_id) == $categoryId ? 'selected' : ''  }}>{{ $categoryName }}</option>
                    @endforeach
                @endif
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Thumbnail</label>
            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid">
            <input type="file" name="thumbnail" placeholder="product thumbnail" class="form-control">
            @error('thumbnail')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Description</label>
            <textarea name="description" rows="2" class="form-control">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Quantity</label>
            <input type="text" name="quantity" placeholder="Product Quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control">
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Content</label>
            <textarea name="content" rows="10" class="form-control">{{ old('content', $product->product_detail ? $product->product_detail->content : null) }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Status</label>
           <div>
                <input type="radio" name="status" value="0" {{ $product->status==0 ? 'checked' : '' }}>
                <label for="">Private</label>
                <input type="radio" name="status" value="1" {{ $product->status==1 ? 'checked' : '' }}>
                <label for="">Public</label>
            </div>
        </div>

         <div class="form-group mb-5">
            <label for="">Product Is_Feature</label>
           <div>
                <input type="radio" name="is_feature" value="0" {{ $product->is_feature==0 ? 'checked' : '' }}>
                <label for="">Old</label>
                <input type="radio" name="is_feature" value="1" {{ $product->is_feature==1 ? 'checked' : '' }}>
                <label for="">New</label>
            </div>
        </div>

        

       

      
        <div class="form-group">
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">List Post</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
