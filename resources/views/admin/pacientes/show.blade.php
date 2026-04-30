@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Paciente: {{ $paciente->nombre . ' ' . $paciente->apellido }}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>

                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
                    <p><strong>Apellido:</strong> {{ $paciente->apellido }}</p>
                    <p><strong>RUT:</strong> {{ $paciente->rut }}</p>

                    @if ($paciente->categoria && $paciente->estado)
                        <p><strong>Categoría:</strong> {{ $paciente->categoria->codigo }} -
                            {{ $paciente->categoria->nombre }}</p>
                        <p><strong>Estado:</strong> {{ $paciente->estado->nombre }}</p>
                    @else
                        <form action="{{ url('/admin/pacientes/condition/' . $paciente->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Selector de categoría --}}
                            @if (!$paciente->categoria)
                                <div class="form-group mt-2">
                                    <label for="categoria_id"><strong>Categoría</strong></label>
                                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="1">ESI 1</option>
                                        <option value="2">ESI 2</option>
                                        <option value="3">ESI 3</option>
                                        <option value="4">ESI 4</option>
                                        <option value="5">ESI 5</option>
                                    </select>
                                </div>
                            @endif

                            {{-- Selector de estado --}}
                            @if (!$paciente->estado)
                                <div class="form-group mt-2">
                                    <label for="estado_id"><strong>Estado</strong></label>
                                    <select name="estado_id" id="estado_id" class="form-control" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="1">Ingresado</option>
                                        <option value="2">En espera de atención</option>
                                        <option value="3">En atención</option>
                                    </select>
                                </div>
                            @endif
                            <hr>
                            <div class="form-group d-flex justify-content-between">
                                <a href="{{ url('admin/pacientes') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Actualizar
                                </button>
                    @endif
                </div>
            </div>
            </form>

        </div>
    </div>
    </div>
@endsection
