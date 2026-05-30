@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Equipos</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('equipos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nuevo Equipo
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tipo de Equipo</th>
                            <th>Número de Serie</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Estado</th>
                            <th>Ubicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($equipos as $equipo)
                            <tr>
                                <td>{{ $equipo->id_equipo }}</td>
                                <td>{{ $equipo->tipo_equipo }}</td>
                                <td>{{ $equipo->num_serie }}</td>
                                <td>{{ $equipo->marca }}</td>
                                <td>{{ $equipo->modelo }}</td>
                                <td>
                                    @if ($equipo->estado == 'Activo')
                                        <span class="badge bg-success">{{ $equipo->estado }}</span>
                                    @elseif ($equipo->estado == 'Inactivo')
                                        <span class="badge bg-danger">{{ $equipo->estado }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $equipo->estado }}</span>
                                    @endif
                                </td>
                                <td>{{ $equipo->ubicacion->nombre_area ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('equipos.show', $equipo->id_equipo) }}" class="btn btn-sm btn-info"
                                        title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('equipos.edit', $equipo->id_equipo) }}" class="btn btn-sm btn-warning"
                                        title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('equipos.destroy', $equipo->id_equipo) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro?')" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No hay equipos registrados. <a href="{{ route('equipos.create') }}">Crear uno ahora</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection