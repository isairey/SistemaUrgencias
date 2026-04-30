@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Registrar nueva atención para {{ $paciente->nombre }} {{ $paciente->apellido }}</h3>

    <form action="{{ route('admin.atenciones.store') }}" method="POST">
        @csrf

        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->codigo . ' ' . $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="estado_id">Estado</label>
            <select name="estado_id" class="form-control">
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar atención</button>
    </form>
</div>
@endsection