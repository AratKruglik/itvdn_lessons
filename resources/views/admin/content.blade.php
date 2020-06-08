@extends('admin.layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                @yield('content')
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
