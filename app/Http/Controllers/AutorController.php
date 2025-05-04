<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Services\AutorService;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Services\LoggerSingleton;

class AutorController extends Controller
{
    //
    protected $autorService;
    protected $logger; 

    public function __construct(AutorService $autorService, LoggerSingleton $logger){
        $this->autorService = $autorService;
        $this->logger = $logger;
    }

    public function index(){
        $this->logger->log('Accediendo al índice de autores');
        $autores = $this->autorService->getAllAutores();
        return response()->json($autores);
    }

    public function show($id)
    {
        $this->logger->log('Accediendo a la visualización de autores');
        $autor = $this->autorService->getAutorById($id);
        return response()->json($autor);
    }

    public function store(StoreAutorRequest $request){
        $this->logger->log('Accediendo al guardado (store) de autores');
        $autor = $this->autorService->createAutor($request->validated());
        //return redirect()->route('autores.index');
        return response()->json($autor);
    }

    public function update(UpdateAutorRequest $request, $id){
        $this->logger->log('Accediendo a la actualización (update) de autores');
        $autor = $this->autorService->getAutorById($id);
        $autor = $this->autorService->updateAutor($autor, $request->validated());
        //return redirect()->route('autores.index');
        return response()->json($autor);
    }

    public function destroy(Autor $autor){
        $this->logger->log('Accediendo a la eliminación de autores');
        $autor = $this->autorService->deleteAutor($autor);
        //return redirect()->route('autores.index');
        return response()->json($autor);
    }
}