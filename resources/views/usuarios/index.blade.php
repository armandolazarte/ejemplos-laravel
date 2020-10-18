@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Usuarios</h3>
                        <div class="float-right">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Nuevo Usuario</a>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop