<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica necesaria para la página de inicio
        return view('home.inicio');
    }
}
