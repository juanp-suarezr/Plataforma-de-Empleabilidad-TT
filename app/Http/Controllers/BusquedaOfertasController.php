<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BusquedaOfertasController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:buscarOfertas-listar', ['only' => ['index', 'store']]);
        
    }

    function index() {
        return Inertia::render('Eventos/Index', [
            
        ]);
    }
}
