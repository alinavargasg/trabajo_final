@extends('layouts.app')

@section('title', 'Préstamos')

@section('content')
    <h1>Registro de Préstamos</h1>
    <a href="{{ route('prestamos.create') }}" class="btn btn-primary mb-3">Nuevo Préstamo</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>LIBRO</th>
            <th>AUTOR</th>
            <th>LECTOR</th>
            <th>FECHA</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prestamos as $prestamo)
            <tr>
                <td>{{ $prestamo->id }}</td>
                <td>{{ $prestamo->libro->titulo }}</td>
                <td>{{ $prestamo->libro->autor->nombre }}</td>
                <td>{{ $prestamo->lector->name }}</td>
                <td>{{ $prestamo->fecha_prestamo }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
