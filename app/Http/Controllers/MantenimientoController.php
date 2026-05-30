<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Equipo;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mantenimientos = Mantenimiento::all();
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::all();
        return view('mantenimientos.create', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_equipo' => 'required|exists:equipos,id_equipo',
            'tipo_mantenimiento' => 'required|string|in:Preventivo,Correctivo',
            'descripcion_falla' => 'required|string',
            'acciones_realizadas' => 'required|string',
            'fecha_mantenimiento' => 'required|date',
        ]);

        Mantenimiento::create($request->all());
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $equipos = Equipo::all();
        return view('mantenimientos.edit', compact('mantenimiento', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_equipo' => 'required|exists:equipos,id_equipo',
            'tipo_mantenimiento' => 'required|string|in:Preventivo,Correctivo',
            'descripcion_falla' => 'required|string',
            'acciones_realizadas' => 'required|string',
            'fecha_mantenimiento' => 'required|date',
        ]);

        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update($request->all());
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->delete();
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado correctamente.');
    }
}
