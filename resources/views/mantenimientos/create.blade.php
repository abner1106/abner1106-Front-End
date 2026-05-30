@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Registrar Nuevo Mantenimiento</h2>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error en la validación:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('mantenimientos.store') }}" method="POST" class="card mt-4 p-4">
                    @csrf

                    <div class="mb-3">
                        <label for="id_equipo" class="form-label">Equipo <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_equipo') is-invalid @enderror" id="id_equipo" name="id_equipo"
                            required>
                            <option value="">-- Selecciona un equipo --</option>
                            @foreach ($equipos as $equipo)
                                <option value="{{ $equipo->id_equipo }}" {{ old('id_equipo') == $equipo->id_equipo ? 'selected' : '' }}>
                                    {{ $equipo->tipo_equipo }} - {{ $equipo->num_serie }}
                                    ({{ $equipo->ubicacion->nombre_area }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_equipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tipo_mantenimiento" class="form-label">Tipo de Mantenimiento <span
                                class="text-danger">*</span></label>
                        <select class="form-select @error('tipo_mantenimiento') is-invalid @enderror"
                            id="tipo_mantenimiento" name="tipo_mantenimiento" required>
                            <option value="">-- Selecciona un tipo --</option>
                            <option value="Preventivo" {{ old('tipo_mantenimiento') == 'Preventivo' ? 'selected' : '' }}>
                                Preventivo</option>
                            <option value="Correctivo" {{ old('tipo_mantenimiento') == 'Correctivo' ? 'selected' : '' }}>
                                Correctivo</option>
                        </select>
                        @error('tipo_mantenimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion_falla" class="form-label">Descripción de la Falla <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control @error('descripcion_falla') is-invalid @enderror"
                            id="descripcion_falla" name="descripcion_falla" rows="3"
                            required>{{ old('descripcion_falla') }}</textarea>
                        @error('descripcion_falla')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="acciones_realizadas" class="form-label">Acciones Realizadas <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control @error('acciones_realizadas') is-invalid @enderror"
                            id="acciones_realizadas" name="acciones_realizadas" rows="3"
                            required>{{ old('acciones_realizadas') }}</textarea>
                        @error('acciones_realizadas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fecha_mantenimiento" class="form-label">Fecha del Mantenimiento <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('fecha_mantenimiento') is-invalid @enderror"
                            id="fecha_mantenimiento" name="fecha_mantenimiento" value="{{ old('fecha_mantenimiento') }}"
                            required>
                        @error('fecha_mantenimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Mantenimiento
                        </button>
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection