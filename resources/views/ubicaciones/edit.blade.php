@extends('layouts.app')

@section('content')
    <h2>Editar Ubicación</h2>

    <form action="{{ route('ubicaciones.update', $ubicacion->id_ubicacion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre del Área</label>
            <input type="text" name="nombre_area" class="form-control"
                value="{{ old('nombre_area', $ubicacion->nombre_area) }}" required>
        </div>
        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" name="capacidad" class="form-control" value="{{ old('capacidad', $ubicacion->capacidad) }}"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('ubicaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection