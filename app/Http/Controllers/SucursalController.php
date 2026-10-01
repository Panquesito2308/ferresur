<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index()
    {

        $sucursales = Sucursal::all();
        return view('administrador.sucursales.index', compact('sucursales'));
    }

    public function create()
    {
        return view('administrador.sucursales.create');
    }

    public function store(Request $request)
    {
        Sucursal::create($request->all());
        return redirect()->route('administrador.sucursales.index');
    }

    public function show(Sucursal $sucursal)
    {
        return view('administrador.sucursales.show', compact('sucursal'));
    }

    public function edit(Sucursal $sucursal)
    {
        return view('administrador.sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, Sucursal $sucursal)
    {
        $sucursal->update($request->all());
        return redirect()->route('administrador.sucursales.index');
    }

    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();
        return redirect()->route('administrador.sucursales.index');
    }
}
