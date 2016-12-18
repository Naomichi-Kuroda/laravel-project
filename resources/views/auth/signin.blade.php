@extends('layouts.app')

@section('content')
{!! Form::open(array('url' => 'authenticate', 'method' => 'post')) !!}
<div class="form-group">
    {!! Form::label('email', 'メールアドレス') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password', 'パスワード') !!}
    {!! Form::password('password', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Signin', ['class' => 'btn btn-primary form-control']) !!}
</div>
{!! Form::close() !!}
@endsection
