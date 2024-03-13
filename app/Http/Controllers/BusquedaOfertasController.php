<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as RequestFacade;
use App\Http\Controllers\Controller;
use App\Models\Ofertas;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BusquedaOfertasController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:buscarOfertas-list', ['only' => ['index', 'store']]);
        
    }

    function index() {
        return Inertia::render('BuscarOfertas/Index', [

            'ofertas' => Ofertas::query()
                ->when(RequestFacade::input('search'),function($query, $search) {
                    $query->where('ubicacion','like','%'.$search.'%')
                    ->OrWhere('nombre_empresa','like','%'.$search.'%');
                })->when(RequestFacade::input('estado_users'), function ($query, $estado) {
                    $query->where('estado', $estado);
                })->with('roles')->paginate(5)
                ->withQueryString(),
                'filters' => RequestFacade::only(['search'])
            
        ]);
    }
}
