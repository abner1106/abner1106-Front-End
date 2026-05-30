@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Detalles del Equipo</h2>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tipo de Equipo</p>
                                <h5>{{ $equipo->tipo_equipo }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Número de Serie</p>
                                <h5>{{ $equipo->num_serie }}</h5>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Marca</p>
                                <p>{{ $equipo->marca }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Modelo</p>
                                <p>{{ $equipo->modelo }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Estado</p>
                                @if ($equipo->estado == 'Activo')
                                    <span class="badge bg-success">{{ $equipo->estado }}</span>
                                @elseif ($equipo->estado == 'Inactivo')
                                    <span class="badge bg-danger">{{ $equipo->estado }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $equipo->estado }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Ubicación</p>
                                <p>{{ $equipo->ubicacion->nombre_area ?? 'N/A' }}</p>
                            </div>
                        </div>

                        @if ($equipo->caracteristicas)
                            <hr>
                            <div class="mb-3">
                                <p class="text-muted mb-1">Características</p>
                                <p>{{ $equipo->caracteristicas }}</p>
                            </div>
                        @endif

                        <hr>

                        <div class="row text-muted small">
                            <div class="col-md-6">
                                <p><strong>Creado:</strong> {{ $equipo->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Actualizado:</strong> {{ $equipo->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Historial de Mantenimientos</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($equipo->mantenimientos as $mantenimiento)
                                    <tr>
                                        <td>{{ $mantenimiento->tipo_mantenimiento }}</td>
                                        <td>{{ Str::limit($mantenimiento->descripcion_falla, 50) }}</td>
                                        <td>{{ $mantenimiento->fecha_mantenimiento->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('mantenimientos.show', $mantenimiento->id_mantenimiento) }}"
                                                class="btn btn-sm btn-info">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            No hay registros de mantenimiento
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('equipos.edit', $equipo->id_equipo) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="{{ route('equipos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <form action="{{ route('equipos.destroy', $equipo->id_equipo) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar este equipo?')">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection