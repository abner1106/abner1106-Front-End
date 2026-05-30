@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ubicaciones</h2>
        <a href="{{ route('ubicaciones.create') }}" class="btn btn-primary">Nueva Ubicación</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Área</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ubicaciones as $ubicacion)
                <tr>
                    <td>{{ $ubicacion->id_ubicacion }}</td>
                    <td>{{ $ubicacion->nombre_area }}</td>
                    <td>{{ $ubicacion->capacidad }}</td>
                    <td>
                        <a href="{{ route('ubicaciones.show', $ubicacion->id_ubicacion) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('ubicaciones.edit', $ubicacion->id_ubicacion) }}"
                            class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('ubicaciones.destroy', $ubicacion->id_ubicacion) }}" method="POST"
                            style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Eliminar ubicación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection