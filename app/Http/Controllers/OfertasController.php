<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ofertas;
use Inertia\Inertia;


class OfertasController extends Controller
{


    function index() {
        // $ofertas = Ofertas::all();

        return Inertia::render('Ofertas/Index');
    }

    public function create()
    {
        return Inertia::render('Ofertas/Create');
    }

    public function store(Request $request)
    {
        // Implementar validación de formulario
        $request->validate([
            // 'empresa_id' => 'required|exists:empresas,id', // Validar existencia de empresa
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'horarios' => 'required|string',
            'jornada' => 'required|string',
            'modalidad_trabajo' => 'required|string',
            'tipo_contrato' => 'required|string',
            'categoria' => 'required|string',
            'cargo' => 'required|string',
            'ubicacion' => 'required|string',
            'salario' => 'required|numeric|min:0', // Salario mínimo no negativo
        ]);

       
        // Crear y persistir nueva oferta
        $oferta = Ofertas::create([
            'empresa_id' => 1,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'horarios' => $request->horarios,
            'jornada' => $request->jornada,
            'modalidad_trabajo' => $request->modalidad_trabajo,
            'tipo_contrato' => $request->tipo_contrato,
            'categoria' => $request->categoria,
            'cargo' => $request->cargo,
            'ubicacion' => $request->ubicacion,
            'salario' => $request->salario,
        ]);

        // return redirect()->route('ofertas.index');
        return to_route('ofertas.index');
    }

    public function show(Oferta $oferta)
    {
        return Inertia::render('Ofertas/Show', compact('oferta'));
    }

    public function edit(Oferta $oferta)
    {
        return Inertia::render('Ofertas/Edit', compact('oferta'));
    }

    public function update(Request $request, Oferta $oferta)
{
    // Implementar validación de formulario
    $validator = Validator::make($request->all(), [
        'empresa_id' => 'required|exists:empresas,id', // Validar existencia de empresa
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'horarios' => 'required|string',
        'jornada' => 'required|string',
        'modalidad_trabajo' => 'required|string',
        'tipo_contrato' => 'required|string',
        'categoria' => 'required|string',
        'cargo' => 'required|string',
        'ubicacion' => 'required|string',
        'salario' => 'required|numeric|min:0', // Salario mínimo no negativo
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Actualizar la oferta con los datos del request
    $oferta->update($request->all());

    return redirect()->route('ofertas.index');
}
    
    
}
