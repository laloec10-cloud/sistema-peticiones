<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function dashboard()
    {
        // Por ahora solo mostrar la vista
        return view('secretaria.dashboard');
    }
}