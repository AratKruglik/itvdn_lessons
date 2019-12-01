@extends('layouts.app')

@section('title') Thanks for your order @stop

@section('content')
    <div class="container">
        <blockquote class="blockquote bq-success">
            <p class="bq-title">Thanks for your order!</p>
            <p>Hey, {{ $order->user->name ?? 'dear customer' }}!</p>

            <p>Your order <strong>#{{ $order->id }}</strong> was successfully created. We will call you as soon as possible!</p>
        </blockquote>

        <div class="row">
            <div class="col">
                <a href="{{ route('index') }}" class="btn btn-success">Get back</a>
            </div>
        </div>
    </div>
@stop
