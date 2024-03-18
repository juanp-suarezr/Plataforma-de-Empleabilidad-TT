<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfilProfesionalController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:perfilProfesional-list|perfilProfesional-edit', ['only' => ['index', 'store']]);
        $this->middleware('permission:perfilProfesional-edit', ['only' => ['edit', 'update']]);
    }
}
