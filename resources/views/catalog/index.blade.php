@extends('layouts.app')

@section('title')
    Catalog
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($products as $product)
                @include('catalog.card', compact('product'))
            @endforeach
        </div>

        <div class="row align-content-center">
            <div class="container">
                <div class="col-4 offset-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
