@extends('layouts.app')

@section('title', 'Nuevo Préstamo')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Registrar Nuevo Préstamo</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="libro_id" class="form-label">Libro</label>
                    <select class="form-select" id="libro_id" name="libro_id" required>
                        <option value="">Seleccione un libro</option>
                        @foreach($libros as $libro)
                            <option value="{{ $libro->id }}"
                                    data-titulo="{{ $libro->titulo }}"
                                    data-codigo="{{ $libro->codigo }}"
                                    data-autor="{{ $libro->autor->nombre }}">
                                {{ $libro->titulo }} - {{ $libro->codigo }} -  {{ $libro->autor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="lector_id" class="form-label">Lector</label>
                    <select class="form-select" id="lector_id" name="lector_id" required>
                        <option value="">Seleccione el lector</option>
                        @foreach($lectores as $lector)
                            <option value="{{ $lector->id }}"
                                    data-name="{{ $lector->name }}"
                                    data-email="{{ $lector->email }}">
                                {{ $lector->name }} - {{ $lector->email }}
                            </option>
                        @endforeach
                    </select>
                </div> <!-- Aquí estoy quedanderellll -->
                <div class="mb-3">
                    <label for="fecha_prestamo" class="form-label">Fecha del préstamo</label>
                    <input type="date" class="form-control" id="fecha_prestamo"
                           name="fecha_prestamo" min="{{ date('Y-m-d') }}" required>
                    <input type="hidden" name="fecha_devolucion_programada">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Registrar Préstamo</button>
                </div>
            </form>
        </div>
    </div>
@endsection
