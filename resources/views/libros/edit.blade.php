@extends('layouts.app')

@section('title', 'Editar Libro')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Editar Libro: {{ $libro->titulo }}</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('libros.update', $libro->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del Libro</label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       value="{{ old('titulo', $libro->titulo) }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="codigo" class="form-label">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo"
                                       value="{{ old('codigo', $libro->codigo) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="autor_id" class="form-label">Autor principal</label>


                                    <select class="form-select" id="autor_id" name="autor_id" required>
                                        <option value="{{ old('autor_id', $libro->autor_id) }}">{{$libro->autor->nombre}}</option>
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
                                <a href="{{ route('libros.show', $libro->id) }}"
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Actualizar Libro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
