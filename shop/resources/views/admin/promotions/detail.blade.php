@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Product Promotion')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Promotion Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Product Promotion ')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-list.css">
@endpush

@section('content')
    {{-- form search --}}
    <h4> Promotion Name :  <td>{{$promotion->name}}</td> </h4>
    <h4> Discount :  <td>{{$promotion->discount}}</td> </h4>

    {{-- create category link --}}


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
                <th>Product name</th>
                <th>Product Id</th>

                <th>Thumbnail</th>
                <th>Quantity</th>

            </tr>
        </thead>
        <tbody>
            @if((!empty($products)))
            @foreach($products as $key => $product)
            <tr>
                <td>{{$key +1}} </td>
                <td>{{$product->name }}</td>
                <td>{{$product->id }}</td>
                <td>
                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid" style="width: 80px; height: 60px;">
                    {{-- <img src="/{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid" style="width: 40px; height: auto;"> --}}
                </td>
                <td>{{$product->quantity }}</td>


            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <td><a href="{{ route('admin.promotion.index') }}" class="btn btn-info"> Back</a></td>
@endsection
