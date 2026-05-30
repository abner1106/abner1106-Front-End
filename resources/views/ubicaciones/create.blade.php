@extends('layouts.app')

@section('content')
    <h2>Agregar Ubicación</h2>

    <form action="{{ route('ubicaciones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre del Área</label>
            <input type="text" name="nombre_area" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" name="capacidad" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('ubicaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection