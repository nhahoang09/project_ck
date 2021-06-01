@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Create Slide')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Slide Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Create Slide')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-create.css">
@endpush

@section('content')

    <h1 class="text-center">Create Slide</h1>
    <!--form search-->
    @include('errors.error')
    <form action="{{ route('admin.slide.store') }}" method="POST" class="form-inline"  enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="form-group mb-5">
                    <label for="">Slide</label>
                    <input type="file" name="slide" placeholder="Slide" class="form-control">
                    @error('slide')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
            <p><a href="{{ route('admin.slide.index') }}"><button class="btn btn-primary">List Slide</button></a></p>
        </div>
    </div>
@endsection
