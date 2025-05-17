<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paralelo;
use Illuminate\Support\Facades\Log;

class ParaleloController extends Controller
{
    //Metodos
    //Metodo Mostrar todos los paralelos
    public function index(){
        return Paralelo::all();
    }
    //Guardar Nuevo Paralelo
public function store(Request $request)
{
    Log::info('Datos que llegan en la petición', $request->all());
    $request->validate([
        'nombre' => 'required|string|max:100|unique:paralelos'
    ]);

    $paralelo = Paralelo::create($request->all());
    Log::info('Paralelo credo con ID: '.$paralelo->id);
 // Log::info('Estudiante credo con ID: '.$estudiante->id);
    return response()->json([
        'mensaje' => 'Paralelo creado exitosamente',
        'paralelo' => $paralelo
    ],201);
}

//Mostrar Paralelo Especifico
public function show($id)
{
    $paralelo = Paralelo::find($id);

    if(!$paralelo){
        return response()->json(['mensaje' => 'Paralelo no encontrado'], 420);
    }

    return $paralelo;
}

//Actualizar Paralelo Existente
public function update(Request $request, $id)
{
    $paralelo = Paralelo::find($id);
    if(!$paralelo){
        return response()->json(['mensaje' => 'Paralelo no encontrado'], 420);
    }

    $request -> validate([
        'nombre' => 'required|string|max:100|unique:paralelos,nombre,' . $id,
    ]);
     $paralelo -> update ($request -> all());
     return response()->json([
        'mensaje' => 'Paralelo actualizado correctamente',
        'paralelo' => $paralelo
     ]);
}

//Eliminar Paralelo
public function destroy($id)
{
    $paralelo = Paralelo::find($id);

    if(!$paralelo){
        return response()->json(['mensaje' => 'Paralelo no encontrado'], 404);
    }
    $paralelo -> delete();
    return response()->json(['mensaje' => 'Paralelo eliminado correctamente']);
}
    
}


