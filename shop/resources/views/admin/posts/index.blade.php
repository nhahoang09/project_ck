@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Post')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Post Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Post')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/posts/post-list.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/posts/post-list.js"></script>
@endpush

@section('content')
    {{-- form search --}}
    @include('admin.posts._search')

    {{-- create post link --}}
    {{-- case 1 --}}
    <p><a href="{{ route('admin.post.create') }}">Create</a></p>
    
    {{-- case 2 --}}
    {{-- <p><a href="/post/create">Create</a></p> --}}

    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    {{-- display list post table --}}
    <table id="post-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Thumbnail</th>
                <th>Category Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($posts))
                @foreach ($posts as $key => $post)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $post->name }}</td>
                        <td>
                            <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->name }}" class="img-fluid" style="width: 40px; height: auto;">
                            <img src="/{{ $post->thumbnail }}" alt="{{ $post->name }}" class="img-fluid" style="width: 40px; height: auto;">
                        </td>
                        <td>{{ $post->category->name }}</td>
                        <td><a href="{{ route('admin.post.show', $post->id) }}">Detail</a></td>
                        <td><a href="{{ route('admin.post.edit', $post->id) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('admin.post.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure DELETE PRODUCT?')" class="btn btn-danger" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $posts->appends(request()->input())->links() }}
@endsection