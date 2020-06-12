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

            {{ Form::model($user, ['route' => ['admin.users.update', $user->getKey()], 'method' => 'put']) }}
            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
            </div>
            <div class="form-group">
                {{ Form::label('lastname', 'Last Name') }}
                {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
            </div>
            <div class="form-group">
                {{ Form::label('phone', 'Phone') }}
                {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone']) }}
            </div>
            <div class="form-group">
                {{ Form::label('address', 'Address') }}
                {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Address']) }}
            </div>
            @if(auth()->user()->is_admin)
                <div class="form-group">
                    {{ Form::label('is_admin', 'Admin') }}
                    {{ Form::checkbox('is_admin', true, $user->is_admin) }}
                </div>
                <div class="form-group">
                    {{ Form::label('is_manager', 'Manager') }}
                    {{ Form::checkbox('is_manager', true, $user->is_manager) }}
                </div>
            @endif
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