@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Perfil</h2>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('perfil.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Nombre</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $usuario->username) }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection