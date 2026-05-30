@extends('layouts.app')

@section('content')
    <h2>Detalles de Ubicación</h2>
    <p><strong>ID:</strong> {{ $ubicacion->id_ubicacion }}</p>
    <p><strong>Nombre del Área:</strong> {{ $ubicacion->nombre_area }}</p>
    <p><strong>Capacidad:</strong> {{ $ubicacion->capacidad }}</p>
    <a href="{{ route('ubicaciones.index') }}" class="btn btn-secondary">Volver</a>
@endsection