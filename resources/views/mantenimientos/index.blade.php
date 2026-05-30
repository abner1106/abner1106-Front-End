@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Mantenimientos</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nuevo Mantenimiento
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
                            <th>Equipo</th>
                            <th>Tipo de Mantenimiento</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mantenimientos as $mantenimiento)
                            <tr>
                                <td>{{ $mantenimiento->id_mantenimiento }}</td>
                                <td>
                                    <a href="{{ route('equipos.show', $mantenimiento->equipo->id_equipo) }}"
                                        class="text-decoration-none">
                                        {{ $mantenimiento->equipo->tipo_equipo }} - {{ $mantenimiento->equipo->num_serie }}
                                    </a>
                                </td>
                                <td>
                                    @if ($mantenimiento->tipo_mantenimiento == 'Preventivo')
                                        <span class="badge bg-info">{{ $mantenimiento->tipo_mantenimiento }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $mantenimiento->tipo_mantenimiento }}</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($mantenimiento->descripcion_falla, 50) }}</td>
                                <td>{{ $mantenimiento->fecha_mantenimiento->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('mantenimientos.show', $mantenimiento->id_mantenimiento) }}"
                                        class="btn btn-sm btn-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('mantenimientos.edit', $mantenimiento->id_mantenimiento) }}"
                                        class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('mantenimientos.destroy', $mantenimiento->id_mantenimiento) }}"
                                        method="POST" style="display:inline;">
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
                                <td colspan="6" class="text-center text-muted py-4">
                                    No hay registros de mantenimiento. <a href="{{ route('mantenimientos.create') }}">Crear uno
                                        ahora</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection