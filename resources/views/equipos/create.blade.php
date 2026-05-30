@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Registrar Nuevo Equipo</h2>

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

                <form action="{{ route('equipos.store') }}" method="POST" class="card mt-4 p-4">
                    @csrf

                    <div class="mb-3">
                        <label for="tipo_equipo" class="form-label">Tipo de Equipo <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('tipo_equipo') is-invalid @enderror" id="tipo_equipo"
                            name="tipo_equipo" value="{{ old('tipo_equipo') }}" required>
                        @error('tipo_equipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="num_serie" class="form-label">Número de Serie <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('num_serie') is-invalid @enderror" id="num_serie"
                            name="num_serie" value="{{ old('num_serie') }}" required>
                        @error('num_serie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="marca" class="form-label">Marca <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('marca') is-invalid @enderror" id="marca"
                                name="marca" value="{{ old('marca') }}" required>
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="modelo" class="form-label">Modelo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('modelo') is-invalid @enderror" id="modelo"
                                name="modelo" value="{{ old('modelo') }}" required>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="caracteristicas" class="form-label">Características</label>
                        <textarea class="form-control @error('caracteristicas') is-invalid @enderror" id="caracteristicas"
                            name="caracteristicas" rows="3">{{ old('caracteristicas') }}</textarea>
                        @error('caracteristicas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado"
                                required>
                                <option value="">-- Selecciona un estado --</option>
                                <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="En mantenimiento" {{ old('estado') == 'En mantenimiento' ? 'selected' : '' }}>
                                    En mantenimiento</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="ubicacion_id" class="form-label">Ubicación <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('ubicacion_id') is-invalid @enderror" id="ubicacion_id"
                                name="ubicacion_id" required>
                                <option value="">-- Selecciona una ubicación --</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id_ubicacion }}" {{ old('ubicacion_id') == $ubicacion->id_ubicacion ? 'selected' : '' }}>
                                        {{ $ubicacion->nombre_area }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ubicacion_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Equipo
                        </button>
                        <a href="{{ route('equipos.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection