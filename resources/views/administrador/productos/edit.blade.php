@extends('layouts.app-master')

@section('content')
<div class="container mt-5">
    <h1>Editar Producto</h1>
    <form action="{{ route('administrador.productos.update', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_sucursal">Sucursal</label>
            <select name="id_sucursal" id="id_sucursal" class="form-control">
                @foreach ($sucursales as $sucursal)
                <option value="{{ $sucursal->id_sucursal }}" {{ $producto->id_sucursal == $sucursal->id_sucursal ? 'selected' : '' }}>{{ $sucursal->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="{{ $producto->precio }}">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $producto->stock }}">
        </div>
        <div class="form-group">
            <label for="categoria">Categoría</label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="Obra Negra" {{ $producto->categoria == 'Obra Negra' ? 'selected' : '' }}>Obra Negra</option>
                <option value="Para El Campo" {{ $producto->categoria == 'Para El Campo' ? 'selected' : '' }}>Para El Campo</option>
                <option value="Laminas" {{ $producto->categoria == 'Laminas' ? 'selected' : '' }}>Laminas</option>
                <option value="Balconeria y Herreria" {{ $producto->categoria == 'Balconeria y Herreria' ? 'selected' : '' }}>Balconeria y Herreria</option>
                <option value="Herramienta" {{ $producto->categoria == 'Herramienta' ? 'selected' : '' }}>Herramienta</option>
                <option value="Impermeabilizante" {{ $producto->categoria == 'Impermeabilizante' ? 'selected' : '' }}>Impermeabilizante</option>
                <option value="Plomeria y Fontaneria" {{ $producto->categoria == 'Plomeria y Fontaneria' ? 'selected' : '' }}>Plomeria y Fontaneria</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection