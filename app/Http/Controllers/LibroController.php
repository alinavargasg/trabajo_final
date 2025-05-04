<?php

namespace App\Http\Controllers;

use App\Services\LibroService;
use App\Http\Requests\StoreLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Models\Libro;
use App\Services\AutorService;
use App\Services\LoggerSingleton;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    protected $libroService;
    protected $autorService;
    protected $logger; 

    public function __construct(LibroService $libroService, AutorService $autorService, LoggerSingleton $logger){
        $this->libroService = $libroService;
        $this->autorService = $autorService;
        $this->logger = $logger;
    }

    public function index(){
        $this->logger->log('Accediendo al índice de libros');
        $libros = $this->libroService->getAllLibros();
        return view('libros.index', compact('libros'));
    }

    public function create(){
        $this->logger->log('Accediendo al registro (create) de libros');
        $autores = $this->autorService->getAllAutores();
        //dd(compact('autores'));
        return view('libros.create', compact('autores'));
    }

    public function store(StoreLibroRequest $request){
        $this->logger->log('Accediendo al guardado (store) de libros');
        $libro = $this->libroService->createLibro($request->validated());
        return redirect()->route('libros.index');
    }

    public function update(UpdateLibroRequest $request, Libro $libro){
        $this->logger->log('Accediendo a la actualización (update) de libros');
        $this->libroService->updateLibro($libro, $request->validated());
        return redirect()->route('libros.index');
    }


    public function destroy(Libro $libro){
        $this->logger->log('Accediendo a la eliminación de libros');
        $this->libroService->deleteLibro($libro);
        return redirect()->route('libros.index');

    }

    public function show(Libro $libro)
    {
        $this->logger->log('Accediendo a la visualización de libros');    
        return view('libros.show', compact('libro'));
    }

    public function edit(Libro $libro)
    {
        $this->logger->log('Accediendo a la edición de libros');
        $autores = $this->autorService->getAllAutores();        
        return view('libros.edit', compact('libro'), compact('autores'));
    }    

}
