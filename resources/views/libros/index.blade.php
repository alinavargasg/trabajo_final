@extends('layouts.app')

@section('title', 'Listado de Libros')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Listado de Libros</h1>
            <a href="{{ route('libros.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Libro
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Código</th>
                    <th>Autor principal</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($libros as $libro)
                    <tr>
                        <td>{{ $libro->id }}</td>
                        <td>{{ $libro->titulo }}</td>
                        <td>{{ $libro->codigo }}</td>
                        <td>{{ $libro->autor->nombre }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('libros.show', $libro->id) }}"
                               class="btn btn-sm btn-info" title="Ver">
                                <i class="fas fa-eye">Ver</i>
                            </a>
                            <a href="{{ route('libros.edit', $libro->id) }}"
                               class="btn btn-sm btn-warning" title="Editar">
                                <i class="fas fa-edit">Editar</i>
                            </a>
                            <form action="{{ route('libros.destroy', $libro->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        title="Eliminar"
                                        onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                                    <i class="fas fa-trash">Eliminar</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay libros registrados</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
