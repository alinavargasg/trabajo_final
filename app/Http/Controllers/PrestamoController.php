<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PrestamoService;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use App\Services\LoggerSingleton;
use Illuminate\Support\Facades\DB;
use App\Facades\NotificadorFacade;

class PrestamoController extends Controller
{
    protected $prestamoService;
    protected $logger;

    public function __construct(PrestamoService $prestamoService, LoggerSingleton $logger)
    {
        $this->prestamoService = $prestamoService;
        $this->logger = $logger;
    }

    public function index()
    {
        $this->logger->log('Accediendo al índice de préstamos');
        $prestamos = Prestamo::with('libro')->latest()->get();
        return response()->json($prestamos);
    }

     public function show($id)
    {
        $this->logger->log('Accediendo a la visualización de préstamos');
        $prestamo = $this->prestamoService->getPrestamoById($id);
        return response()->json($prestamo);
    }

    public function store(Request $request)
    {
        $this->logger->log('Accediendo al guardado (store) de préstamos');
        $libro = Libro::findOrFail($request->libro_id); //Verificar si los nombres son correctos
        $lector = User::findOrFail($request->lector_id); //Verificar si los nombres son correctos
        DB::beginTransaction();

        try {
            $this->prestamoService->validarLibro($libro);
            $this->prestamoService->validarLector($lector);
            $prestamo = $this->prestamoService->createPrestamo([
                'fecha_prestamo' => $request->fecha_prestamo,
                'libro_id' => $libro->id,
                'encargado_id' => 1, //$request->encargado_id, (esto queda pendiente hasta que se implemente el inicio de sesión)
                'lector_id' => $lector->id,
                'estado' => '1'
            ]);
            DB::commit();
            NotificadorFacade::enviar($lector, 'Tu préstamo fue realizado.');    //Patrón de diseño Facade.
            return response()->json($prestamo);
            //return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado');
        } catch (\App\Exceptions\ValidationException $e) {
            DB::rollback();
            //return back()->withInput()->with('error', $e->getMessage());
            return response()->json(['error'=> $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $this->logger->log('Accediendo a la eliminación de préstamos');
        $prestamo = $this->prestamoService->getPrestamoById($id);
        DB::beginTransaction();
        try {
            $this->prestamoService->deletePrestamo($prestamo);
            DB::commit();
            return response()->json($prestamo);
        }catch(\App\Exceptions\ValidationException $e) {
            DB::rollback();
            return response()->json(['error'=> $e->getMessage()]);
        }
    }
}
