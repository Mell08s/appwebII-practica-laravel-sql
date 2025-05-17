<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paralelo;
use Illuminate\Support\Facades\Log;

class EstudianteController extends Controller
{
    //Mostrar Estudiantes
    public function index()
    {
        $estudiantes = Estudiante::with('paralelo')->get();
        $resultado = $estudiantes->map(function ($est){
         return[
            'id' => $est -> id,
            'nombre' => $est -> nombre,
            'cedula' => $est -> cedula,
            'correo' => $est -> correo,
            'paralelo' => $est -> paralelo->nombre ?? null,
         ];
        });
        return response()->json($resultado);
    }

    //Guardar Estudiante
    public function store(Request $request)
{
    Log::info('Intentando crear estudiante', $request->all());

    $request->validate([
        'nombre' => 'required|string|max:100',
        'cedula' => 'required|string|max:10|unique:estudiantes',
        'correo' => 'required|email|unique:estudiantes',
        'paralelo_id' => 'required|exists:paralelos,id',
    ]);

    $estudiante = Estudiante::create($request->all());

    Log::info('Estudiante creado con ID: ' . $estudiante->id);

    return response()->json([
        'mensaje' => 'Estudiante creado exitosamente',
        'estudiante' => $estudiante,
    ], 201);
}
 //Mostrar Estudiante
 public function show(string $id)
{
    $estudiante = Estudiante::with('paralelo')->findOrFail($id);
    
     if (!$estudiante) {
        return response()->json(['mensaje' => 'Estudiante no encontrado'], 404);
    }
     
    return response()->json([
        'id' => $estudiante->id,
        'nombre' => $estudiante->nombre,
        'cedula' => $estudiante->cedula,
        'correo' => $estudiante->correo,
        'paralelo' => $estudiante->paralelo->nombre ?? null,
    ]);
}

//Actualizar Estudiante
public function update(Request $request, string $id)
{
    $estudiante = Estudiante::find($id);

    if (!$estudiante) {
        return response()->json(['mensaje' => 'Estudiante no encontrado'], 404);
    }

    $request->validate([
        'nombre' => 'sometimes|required|string|max:100',
        'cedula' => 'sometimes|required|string|max:10|unique:estudiantes,cedula,' . $id,
        'correo' => 'sometimes|required|email' . $id,
        'paralelo_id' => 'sometimes|required|exists:paralelos,id',
    ]);

    $estudiante->update($request->all());

    return response()->json([
        'mensaje' => 'Estudiante actualizado correctamente',
        'estudiante' => $estudiante,
    ]);
}

//Eliminar Estudiante
public function destroy(string $id)
{
    $estudiante = Estudiante::find($id);

    if (!$estudiante) {
        return response()->json(['mensaje' => 'Estudiante no encontrado'], 404);
    }

    $estudiante->delete();

    return response()->json(['mensaje' => 'Estudiante eliminado correctamente']);
}

}
