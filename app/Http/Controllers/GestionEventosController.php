<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GestionEventosController extends Controller


{
    function __construct()
    {
        $this->middleware('permission:eventos-list|eventos-create|eventos-edit|eventos-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:eventos-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:eventos-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eventos-delete', ['only' => ['destroy']]);
    }

    function index() {
        return Inertia::render('Eventos/Index', [
            
        ]);
    }
}
