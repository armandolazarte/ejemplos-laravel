<?php

use App\Models\Localidad;
use App\Models\Departamento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('usuarios', UsuarioController::class);

Route::get('/departamentos/{id}', function ($id) {
    return Departamento::where('provincia_id', $id)->get();
});

Route::get('/localidades/{id}', function ($id) {
    return Localidad::where('departamento_id', $id)->get();
});
