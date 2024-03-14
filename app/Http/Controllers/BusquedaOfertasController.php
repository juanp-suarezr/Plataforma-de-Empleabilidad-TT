<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as RequestFacade;
use App\Http\Controllers\Controller;
use App\Models\Ofertas;
use App\Models\User;
use Illuminate\Http\Request;
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
                ->join('users', 'ofertas.empresa_id', '=', 'users.id')
                ->select('ofertas.*', 'users.name', 'users.imagen', 'users.identificacion', 'users.telefono')
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
}
