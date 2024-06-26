@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Esqueci minha senha</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Link de Redefinição de Senha</button>
    </form>
</div>
@endsection