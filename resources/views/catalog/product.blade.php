@extends('layouts.app')

@section('title') {{ $product->title }} @stop

@section('content')
    <div class="container dark-grey-text mt-5">

        <!--Grid row-->
        <div class="row wow fadeIn">
            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $product->cover }}" class="img-fluid img-thumbnail"
                             alt="">
                    </div>
                </div>
                <div class="row mt-2">
                    @foreach($product->gallery->images as $photo)
                        <div class="col-3">
                            <img src="{{ $photo->path }}" alt="" class="img-fluid img-thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Content-->
                <div class="p-4">

                    <div class="mb-3">
                        @foreach($product->categories as $category)
                            <a href="">
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
                                mr-1">{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>

                    <p class="lead">
              <span class="mr-1">
              </span>
                        <span>${{ $product->price }}</span>
                    </p>

                    <p class="lead font-weight-bold">Description</p>

                    <p>
                        {{ $product->description }}
                    </p>
                </div>
                <!--Content-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <!--Grid row-->
        <div class="row d-flex justify-content-center wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 text-center">

                <h4 class="my-4 h4">Additional information</h4>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta
                    odit voluptates,
                    quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->
        </div>
    </div>
@stop
