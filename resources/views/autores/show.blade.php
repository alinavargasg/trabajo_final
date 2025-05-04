@extends('layouts.app')

@section('title', 'Detalles del Libro')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Detalles del Libro</h2>
                    <div class="btn-group">
                        <a href="{{ route('libros.edit', $libro->id) }}"
                           class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('libros.destroy', $libro->id) }}"
                              method="POST" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $libro->titulo }}</h3>
                        <hr>
                        <p><strong>Código:</strong> {{ $libro->codigo }}</p>
                        <p><strong>Autor principal:</strong> {{ $libro->autor }} </p>
                        <p><strong>Estado:</strong> {{ $libro->estado() }} </p>
                        <p><strong>Fecha de creación:</strong> {{ $libro->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Última actualización:</strong> {{ $libro->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Registro de Préstamos</h4>
                        @if($libro->prestamos->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Lector</th>
                                        <th>Encargado</th>
                                        <th>Estado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($libro->prestamos as $prestamo)
                                        <tr>
                                            <td>{{ $prestamo->fecha->format('d/m/Y') }}</td>
                                            <td>{{ $prestamo->lector->name() }}</td>
                                            <td>{{ $prestamo->encargado->name() }}</td>
                                            <td>{{ $prestamo->estado() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">No hay préstamos registradas para este libro</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('libros.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
@endsection
