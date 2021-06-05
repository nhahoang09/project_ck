@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Users')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Users Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Users')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/orders/order-list.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/orders/order-list.js"></script>
@endpush

@section('content')

    <p><a href="{{ route('admin.user.create') }}" class="btn btn-primary" title="Create Product">Create</a></p>
    {{-- form search --}}
    {{-- @include('admin.orders._search') --}}

    {{-- show message --}}
    @include('errors.error')

    {{-- display list order table --}}
    <table id="product-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>Email</th>
                {{-- <th>Phone</th>
                <th>Address</th> --}}
                <th>Role_id</th>
                <th>Status</th>
                <th colspan="2">Active/De-active</th>
                <th>Create Date</th>

                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($users))
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_id }}</td>
                        <td>
                            @if ($user->role_id == 2)
                            <div class="alert alert-primary" role="alert">Shipper</div>
                        @endif
                        </td>
                        <td>{{ $user->status  }}</td>
                        <td><a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-secondary">Active/De-active</a></td>
                        <td>{{ $user->created_at }}</td>

                        <td>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="post">
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

    {{$users ->appends(request()->input())->links() }}




@endsection
