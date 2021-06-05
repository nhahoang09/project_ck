<table id="product-list" class="table table-striped table-bordered table-hover">
    <thead class="table-dark ">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Thumbnail</th>
            <th>Category Name</th>
            <th colspan="5" class="center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($products))
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid" style="width: 40px; height: auto;">
                        {{-- <img src="/{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid" style="width: 40px; height: auto;"> --}}
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td><a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-secondary">Detail</a></td>
                    <td><a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info">Edit</a></td>
                    <td><a href="{{ route('admin.product.price.index', $product->id) }}" class="btn btn-info">Price</a></td>
                    <td>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="post">
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

{{ $products->appends(request()->input())->links() }}
