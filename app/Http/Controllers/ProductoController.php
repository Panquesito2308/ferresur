<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('sucursal')->paginate(5);;
        return view('administrador.productos.index', compact('productos'));
    }

    public function generarReporte()
    {
        $productos = Producto::with('sucursal')->get();
        $pdf = Pdf::loadView('administrador.productos.productos_reporte', compact('productos'));
        return $pdf->download('reporte_productos.pdf');
    }
    public function create()
    {
        $sucursales = Sucursal::all();
        return view('administrador.productos.create', compact('sucursales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:30',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => ['required', Rule::in([
                'Obra Negra',
                'Para El Campo',
                'Laminas',
                'Balconeria y Herreria',
                'Herramienta',
                'Impermeabilizante',
                'Plomeria y Fontaneria'
            ])],
        ]);

        Producto::create($request->all());
        return redirect()->route('administrador.productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $sucursales = Sucursal::all();
        return view('administrador.productos.edit', compact('producto', 'sucursales'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => ['required', Rule::in([
                'Obra Negra',
                'Para El Campo',
                'Laminas',
                'Balconeria y Herreria',
                'Herramienta',
                'Impermeabilizante',
                'Plomeria y Fontaneria'
            ])],
        ]);

        $producto->update($request->all());
        return redirect()->route('administrador.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('administrador.productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
