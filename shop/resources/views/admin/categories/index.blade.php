@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Category')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Category Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Category')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-list.css">
@endpush

@section('content')
    {{-- form search --}}

    {{-- create category link --}}
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <p><a href="{{ route('admin.category.create') }}"><button class="btn btn-primary">Create</button></a></p>
            {{-- <p><a href="/category/create"><button class="btn btn-primary">Create</button></a></p> --}}
        </div>
    </div>

    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    {{-- display list category table --}}
    <table id="category-list" class="table table-striped table-bordered table-hover">
        <thead class="table-dark ">
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th colspan="3" id="action">Action</th>
            </tr>
        </thead>
        <tbody>
            @if((!empty($categories)))
            @foreach($categories as $key => $category)
            <tr>
                <td>{{$key +1}} </td>
                <td>{{$category ->name}}</td>
                <td><a href="{{ route('admin.category.show',$category->id) }}">Detail</a> </td>
                <td><a href="{{ route('admin.category.edit',$category->id) }}"> Edit</a></td>
                <td>
                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure DELETE CATEGORY?')" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
@endsection
