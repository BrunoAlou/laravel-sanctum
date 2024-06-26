@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Usuários Cadastrados</h2>
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>
</div>
@endsection
