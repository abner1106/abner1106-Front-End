<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return view('ubicaciones.index', compact('ubicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ubicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_area' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
        ]);

        Ubicacion::create($request->all());
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        return view('ubicaciones.show', compact('ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_area' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
        ]);

        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($request->all());
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->delete();
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación eliminada.');
    }
}

