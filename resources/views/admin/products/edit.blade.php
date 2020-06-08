@extends('admin.content')

@section('title') Edit product @endsection

@section('content')
    @include('admin.products.form', compact('product'))
@endsection