@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Edit Slide')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Slide Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Edit Slide')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-edit.css">
@endpush

@section('content')
    <h4>Edit Slide</h4>



    <form action="{{ route('admin.slide.update', $slide->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="form-group mb-5">
                    <label for="">Slide </label>
                    <img src="{{ asset($slide->url) }}" alt="" class="img-fluid" height="20px" width="250px">
                    <input type="file" name="slide" placeholder="slide" class="form-control">
                    @error('slide')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
    </form>

    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

            <p><a href="{{ route('admin.slide.index') }}"><button class="btn btn-primary">List Slide</button></a></p>
        </div>
    </div>
@endsection
