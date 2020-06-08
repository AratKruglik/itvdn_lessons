@extends('admin.content')

@section('title') Products @endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    {{ $products->links() }}
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create</a>
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
                            <tr>
                                <td>{{ $product->getKey() }}</td>
                                <td>{{ $product->title }}</td>
                                <td>
                                    @foreach($product->categories as $category)
                                            <span class="badge
                                             @if ($category->id == 1)
                                                    purple
                                             @elseif($category->id == 2)
                                                    blue
                                            @elseif($category->id == 3)
                                                    red
                                            @elseif($category->id == 4)
                                                    yellow
                                            @elseif($category->id == 5)
                                                    lime
                                            @endif
                                                    mr-1">{{ $category->name }}
                                            </span>
                                    @endforeach
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="/edit/{{ $product->getKey() }}" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                        @if(auth()->user()->is_admin)
                                            @if($product->trashed())
                                                <a href="#" class="btn btn-warning">Restore</a>
                                            @else
                                                <a href="#" class="btn btn-danger">DROP</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
