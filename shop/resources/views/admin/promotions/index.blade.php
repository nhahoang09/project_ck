@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Promotion')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Promotion Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Promotion ')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/categories/category-list.css">
@endpush

@section('content')
    {{-- form search --}}
    <h4>List promotion of {{$product['name']}}:</h4>

    {{-- create category link --}}
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <p><a href="{{ route('admin.product.promotion.create',$product->id) }}"><button class="btn btn-primary">Create</button></a></p>
            
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
                <th>Discount(%)</th>
                <th>Product Name</th>
                <th>Begin date</th>
                <th>End date</th>
                <th>Status</th>
                <th colspan="3" id="action">Action</th>
            </tr>
        </thead>
        <tbody>
            @if((!empty($promotions)))
            @foreach($promotions as $key => $promotion)
            <tr>
                <td>{{$key +1}} </td>
                <td>{{$promotion ->discount}}</td>
                <td>{{$product->name}}</td>
                <td>{{$promotion->begin_date }}</td>
                <td>{{$promotion->end_date }}</td>
                <td>{{$promotion->status }}</td>
                <td><a href="{{ route('admin.product.promotion.edit',[$product->id,$promotion->id]) }}" class="btn btn-info"> Edit</a></td>
                <td>
                    <form action="{{ route('admin.product.promotion.destroy',[$product->id,$promotion->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure DELETE PROMOTION?')" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
@endsection
