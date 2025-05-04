@extends('layouts.app')

@section('title', 'Registrar Nuevo Libro')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Registrar Nuevo Libro</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('libros.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del Libro</label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       required autofocus>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="codigo" class="form-label">Codigo</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo"
                                       required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="autor_id" class="form-label">Autor principal</label>
                                    <select class="form-select" id="autor_id" name="autor_id" required>
                                        <option value="">Seleccione el Autor</option>
                                        @foreach($autores as $autor)
                                            <option value="{{ $autor->id }}"
                                                    data-name="{{ $autor->name }}">
                                                {{ $autor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('libros.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar Libro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
