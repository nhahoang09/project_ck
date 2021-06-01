@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Slide')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Slide Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Slide')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-list.css">
@endpush

@section('content')
    {{-- form search --}}

    {{-- create category link --}}
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <p><a href="{{ route('admin.slide.create') }}"><button class="btn btn-primary">Create</button></a></p>
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
                <th>Slide</th>
                <th colspan="3" id="action">Action</th>
            </tr>
        </thead>
        <tbody>
            @if((!empty($slides)))
            @foreach($slides as $key => $slide)
            <tr>
                <td>{{$key +1}} </td>
                <td>
                <img src="{{ asset($slide->url) }}"  class="img-fluid" style="width: 150px; height: 100px;">
                </td>
                {{-- <td><a href="{{ route('admin.slide.show',$slide->id) }}">Detail</a> </td> --}}
                <td><a href="{{ route('admin.slide.edit',$slide->id) }}" class="btn btn-info"> Edit</a></td>
                <td>
                    <form action="{{ route('admin.slide.destroy', $slide->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure DELETE SLIDE?')" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
@endsection
