@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Customer')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Customer Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Customer')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/orders/order-list.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/orders/order-list.js"></script>
@endpush

@section('content')
    {{-- form search --}}
    @include('admin.customers._search')

    {{-- show message --}}
    @include('errors.error')

    {{-- display list order table --}}
    <table id="product-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Create Date</th>

                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($customers))
                @foreach ($customers as $key => $customer)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->created_at }}</td>

                        <td>
                            <form action="{{ route('admin.order.destroy', $customer->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure DELETE Customer?')" class="btn btn-danger" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{$customers ->appends(request()->input())->links() }}




@endsection
