<div class="col-3 mb-4">
    <div class="card">
        <img class="card-img-top" src=".../100px180/" alt="{{ $product->title }}">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('catalog.show', $product) }}">
                    {{ $product->title }}
                </a>

            </h5>
            <p>&dollar; {{ $product->price }}</p>
            <p class="card-text">
                {{ str_limit($product->description, 150, '...') }}
            </p>

        </div>
        <div class="card-footer">
                <span class="badge badge-secondary {{ $product->stock > 0 ? 'badge-success' : 'badge-danger'}}">
                    {{ $product->stock > 0 ? 'In Stock' : 'Not In Stock'}}
                </span>
            <span class="float-right">
                <a href="{{ route('cart.add', ['productId' => $product->id]) }}" class="text-muted">
                    <i class="fas fa-cart-arrow-down"></i>
                </a>
            </span>
        </div>
    </div>
</div>
