<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function dashboard()
    {
        return view('administrador.dashboard');
    }
    public function download()
    {
        return view('administrador.download');
    }
}
