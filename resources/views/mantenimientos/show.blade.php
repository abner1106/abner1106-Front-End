@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Detalles del Mantenimiento</h2>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Información General</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">ID Mantenimiento</p>
                                <h5>{{ $mantenimiento->id_mantenimiento }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Equipo</p>
                                <h5>
                                    <a href="{{ route('equipos.show', $mantenimiento->equipo->id_equipo) }}"
                                        class="text-decoration-none">
                                        {{ $mantenimiento->equipo->tipo_equipo }}
                                    </a>
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Número de Serie</p>
                                <p>{{ $mantenimiento->equipo->num_serie }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Ubicación</p>
                                <p>{{ $mantenimiento->equipo->ubicacion->nombre_area }}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tipo de Mantenimiento</p>
                                @if ($mantenimiento->tipo_mantenimiento == 'Preventivo')
                                    <span class="badge bg-info fs-6">{{ $mantenimiento->tipo_mantenimiento }}</span>
                                @else
                                    <span class="badge bg-warning fs-6">{{ $mantenimiento->tipo_mantenimiento }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Fecha</p>
                                <p>{{ $mantenimiento->fecha_mantenimiento->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Descripción de la Falla</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $mantenimiento->descripcion_falla }}</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Acciones Realizadas</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $mantenimiento->acciones_realizadas }}</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body text-muted small">
                        <p><strong>Creado:</strong> {{ $mantenimiento->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Actualizado:</strong> {{ $mantenimiento->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('mantenimientos.edit', $mantenimiento->id_mantenimiento) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <form action="{{ route('mantenimientos.destroy', $mantenimiento->id_mantenimiento) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar este mantenimiento?')">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection