<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ubicaciones = Ubicacion::all();
        return view('equipos.create', compact('ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_equipo' => 'required|string|max:255',
            'num_serie' => 'required|string|unique:equipos,num_serie',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'caracteristicas' => 'nullable|string',
            'estado' => 'required|string|in:Activo,Inactivo,En mantenimiento',
            'ubicacion_id' => 'required|exists:ubicaciones,id_ubicacion',
        ]);

        Equipo::create($request->all());
        return redirect()->route('equipos.index')->with('success', 'Equipo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        $ubicaciones = Ubicacion::all();
        return view('equipos.edit', compact('equipo', 'ubicaciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_equipo' => 'required|string|max:255',
            'num_serie' => 'required|string|unique:equipos,num_serie,' . $id . ',id_equipo',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'caracteristicas' => 'nullable|string',
            'estado' => 'required|string|in:Activo,Inactivo,En mantenimiento',
            'ubicacion_id' => 'required|exists:ubicaciones,id_ubicacion',
        ]);

        $equipo = Equipo::findOrFail($id);
        $equipo->update($request->all());
        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente.');
    }
}
