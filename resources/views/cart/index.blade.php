@extends('layouts.app')

@section('title') Cart @endsection

@section('content')
    <div class="container wow fadeIn">
        <h2 class="my-5 h2 text-center">Your cart</h2>

        @if(Cart::count() > 0)
            <table class="table table-striped">
                <thead class="black white-text">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0; @endphp
                @foreach(Cart::content() as $key => $item)
                    @php $i++; @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="post">
                                {!! method_field('patch') !!}
                                {!! csrf_field() !!}
                                <input type="hidden" name="productId" value="{{ $item->rowId }}">
                                <input type="number" name="qty" value="{{ $item->qty }}" min="1">
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('cart.drop', ['productId' => $item->rowId]) }}" type="button"
                               class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">Total:</td>
                    <td><strong>&dollar;{{ Cart::total() }}</strong></td>
                </tr>
                </tfoot>
            </table>
            <a href="{{ route('cart.destroy') }}" class="btn-danger btn btn-lg">Clear cart</a>
            <a href="{{ route('cart.checkout') }}" class="btn-success btn btn-lg">
                Checkout <i class="fa fa-arrow-right"></i>
            </a>
        @else
            <blockquote class="blockquote bq-warning">
                <p class="bq-title">Do you like our products?</p>
                <p>Your cart is empty now. You can choose product in our <a href="{{ url('catalog') }}">catalog</a> and
                    enjoy them!
                </p>
            </blockquote>
        @endif
    </div>
@stop
