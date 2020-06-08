@extends('admin.content')

@section('title') Edit user @endsection

@section('content')
    @include('admin.users.form', compact('user'))
@endsection