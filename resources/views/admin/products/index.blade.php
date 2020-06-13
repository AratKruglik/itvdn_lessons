@extends('admin.content')

@section('title') Products @endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    {{ $products->links() }}
                    <div class="mt-2">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Categories</th>
                            <th>Price</th>
                            <th>Barcode</th>
                            <th>Stock</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            @if(!$product->trashed())
                            <tr>
                                <td>{{ $product->getKey() }}</td>
                                <td>{{ $product->title }}</td>
                                <td>
                                    @foreach($product->categories as $category)
                                            <span class="badge
                                             @if ($category->id == 1)
                                                    bg-teal
                                             @elseif($category->id == 2)
                                                    bg-purple
                                            @elseif($category->id == 3)
                                                    bg-maroon
                                            @elseif($category->id == 4)
                                                    bg-navy
                                            @elseif($category->id == 5)
                                                    bg-success
                                            @endif
                                                    mr-1">{{ $category->name }}
                                            </span>
                                    @endforeach
                                </td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.products.edit', ['product' => $product->getKey()]) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admin.products.delete', ['product' => $product->getKey()]) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    @if(count($trashedProducts) > 0)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('title') | Trashed</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Barcode</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trashedProducts as $trashedProduct)
                                @canany(['can-destroy', 'can-restore'], $trashedProduct)
                                <tr>
                                    <td>{{ $trashedProduct->getKey() }}</td>
                                    <td>{{ $trashedProduct->title }}</td>
                                    <td>{{ $trashedProduct->barcode }}</td>
                                    <td>{{ $trashedProduct->stock }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.products.restore', ['product' => $trashedProduct->getKey()]) }}" class="btn btn-warning">Restore</a>
                                            <a href="{{ route('admin.products.destroy', ['product' => $trashedProduct->getKey()]) }}" class="btn btn-danger">DROP</a>
                                        </div>
                                    </td>
                                </tr>
                                @endcanany
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>destroy
            <!-- /.card -->
        </div>
    @endif
@endsection
