<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@yield('title')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if($errors->count() > 0)
                <p>The following errors have occurred:</p>
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{$message}}</li>
                    @endforeach
                </ul>
            @endif
            @if(!isset($product))
                {{ Form::open(['route' => ['admin.products.store'], 'method' => 'post']) }}
            @else
                {{ Form::model($product, ['route' => ['admin.products.update', $product->getKey()], 'method' => 'put']) }}
            @endif
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
            </div>
            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) }}
            </div>
            <div class="form-group">
                {{ Form::label('price', 'Price') }}
                {{ Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) }}
            </div>
            <div class="form-group">
                {{ Form::label('barcode', 'Barcode') }}
                {{ Form::text('barcode', null, ['class' => 'form-control', 'placeholder' => 'Barcode']) }}
            </div>
            <div class="form-group">
                {{ Form::label('stock', 'On Stock Count') }}
                {{ Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'On Stock Count']) }}
            </div>
            <div class="form-group">
                {{ Form::label('categories', 'Categories') }}
                {{ Form::select('categories', $categories, $productCategories,
                                ['class' => 'form-control', 'placeholder' => 'Select categories', 'multiple', 'name' => 'categories[]']
                ) }}
            </div>
            <div class="form-group">
                {{ Form::label('cover', 'Cover image') }}
                {{ Form::text('cover', null, ['class' => 'form-control', 'placeholder' => 'Cover Image URL']) }}
            </div>
        <!-- /.card-body -->
            <div class="card-footer">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>