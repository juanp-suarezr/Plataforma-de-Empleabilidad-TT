<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as RequestFacade;
use App\Http\Controllers\Controller;
use App\Models\Ofertas;
use App\Models\Postulaciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BusquedaOfertasController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:buscarOfertas-list', ['only' => ['index', 'store']]);
    }

    function index()
    {
        return Inertia::render('BuscarOfertas/Index', [

            'ofertas' => Ofertas::query()
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('postulaciones')
                        ->whereColumn('postulaciones.oferta_id', 'ofertas.id')
                        ->where('postulaciones.campista_id', Auth::id());
                })
                ->join('users', 'ofertas.empresa_id', '=', 'users.id')
                ->select('ofertas.*', 'users.name', 'users.imagen', 'users.identificacion', 'users.telefono', 'users.email')
                ->when(RequestFacade::input('search'), function ($query, $search) {
                    $query->where('ubicacion', 'like', '%' . $search . '%')
                        ->OrWhere('name', 'like', '%' . $search . '%');
                })->when(RequestFacade::input('jornada'), function ($query, $jornada) {
                    $query->where('jornada', $jornada);
                })->paginate(5)
                ->withQueryString(),
            'filters' => RequestFacade::only(['search'])

        ]);
    }


    function create(Request $request)
    {
        // Implementar validación de formulario
        $request->validate([
            'oferta_id' => 'required',
            'campista_id' => 'required',
            'empresa_email' => 'required|string',
            'estado_post' => 'required|string',

        ]);



        // Crear y persistir nueva oferta
        Postulaciones::create([
            'campista_id' => Auth::id(),
            'oferta_id' => $request->oferta_id,
            'empresa_email' => $request->empresa_email,
            'estado_post' => $request->estado_post,

        ]);

        // return redirect()->route('ofertas.index');
        return Redirect::route('buscarOfertas.index')->with('success', "Registrado exitosamente");
    }
}
