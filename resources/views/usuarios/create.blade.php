@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Agregar Usuario</h3>
                    </div>

                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nombre" class="col-md-3 col-form-label text-md-right">Nombre</label>

                                <div class="col-md-7">
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autofocus>

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellido" class="col-md-3 col-form-label text-md-right">Apellido</label>

                                <div class="col-md-7">
                                    <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" autofocus>

                                    @error('apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="provincia" class="col-md-3 col-form-label text-md-right">Provincia</label>

                                <div class="col-md-7">
                                    <select id="provincia" name="provincia" class="form-control @error('provincia') is-invalid @enderror">
                                        <option value="" disabled selected>SELECCIONE LA PROVINCIA</option>

                                        @foreach($provincias as $provincia)
                                            <option value="{{ $provincia->id }}" {{ old('provincia') == $provincia->id ? 'selected' : '' }}>
                                                {{ $provincia->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('provincia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="departamento" class="col-md-3 col-form-label text-md-right">Departamento</label>

                                <div class="col-md-7">
                                    <select id="departamento" data-old="{{ old('departamento') }}" name="departamento" class="form-control @error('departamento') is-invalid @enderror">
                                        <option value="" disabled selected>SELECCIONE EL DEPARTAMENTO</option>
                                    </select>

                                    @error('departamento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="localidad" class="col-md-3 col-form-label text-md-right">Localidad</label>

                                <div class="col-md-7">
                                    <select id="localidad" data-old="{{ old('localidad') }}" name="localidad" class="form-control @error('localidad') is-invalid @enderror">
                                        <option value="" disabled selected>SELECCIONE LA LOCALIDAD</option>
                                    </select>

                                    @error('localidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $.fn.llenarSelect = function (values, texto, id) {
            var opciones = '<option value="">' + texto + '</option>';

            $.each(values, function (index, value) {
                opciones += '<option value="' + value.id + '"' + (id == value.id ? "selected" : "") + '>' + value.nombre + '</option>';
            })

            $(this).html(opciones);
        };

        $(function () {
            function cargarSelect(url, idAnterior, idPrincipal, idSecundario, texto) {
                var id = $(idPrincipal).val();

                if (idAnterior) {
                    var urlCompleta = url + idAnterior;
                } else {
                    var urlCompleta = url + id;
                }

                if (id === '') {
                    $(idSecundario).empty();
                } else {
                    $.getJSON(urlCompleta, null, function (values) {
                        $(idSecundario).llenarSelect(values, texto, $(idSecundario).data('old'));
                    })
                }
            }

            /* DEPARTAMENTO */
            cargarSelect('/departamentos/', null, '#provincia', '#departamento', 'SELECCIONE EL DEPARTAMENTO');

            $('#provincia').change(function () {
                $('#departamento').empty();
                $('#localidad').empty();
                $('#departamento').append("<option value=''>SELECCIONE EL DEPARTAMENTO</option>");
                $('#localidad').append("<option value=''>SELECCIONE LA LOCALIDAD</option>");

                cargarSelect('/departamentos/', null, '#provincia', '#departamento', 'SELECCIONE EL DEPARTAMENTO');
            });

            /* LOCALIDAD */
            cargarSelect('/localidades/', $('#departamento').data('old'), '#departamento', '#localidad', 'SELECCIONE LA LOCALIDAD');

            $('#departamento').change(function () {
                $('#localidad').empty();
                $('#localidad').append("<option value=''>SELECCIONE LA LOCALIDAD</option>");

                cargarSelect('/localidades/', null, '#departamento', '#localidad', 'SELECCIONE LA LOCALIDAD');
            });
        });
    </script>
@endpush