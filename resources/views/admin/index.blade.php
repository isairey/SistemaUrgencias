@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Panel Principal</h1>
    </div>

    <hr>

    <div class="row">
        @can('admin.usuarios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_usuarios }}</h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-person"></i>
                    </div>
                    <a href="{{ url('admin/usuarios') }}" class="small-box-footer">Más Información <i
                            class="fas bi bi-file-person"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.admisiones.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $total_admisiones }}</h3>
                        <p>Admision</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-person"></i>
                    </div>
                    <a href="{{ url('admin/admisiones') }}" class="small-box-footer">Más Información <i
                            class="fas bi bi-file-person"></i></a>
                </div>
            </div>
        @endcan


        @can('admin.enfermeros.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total_enfermeros }}</h3>
                        <p>Enfermeros/as</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-person"></i>
                    </div>
                    <a href="{{ url('admin/enfermeros') }}" class="small-box-footer">Más Información <i
                            class="fas bi bi-file-person"></i></a>
                </div>
            </div>
        @endcan


        @can('admin.pacientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_pacientes }}</h3>
                        <p>Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-person"></i>
                    </div>
                    <a href="{{ url('admin/pacientes') }}" class="small-box-footer">Más Información <i
                            class="fas bi bi-file-person"></i></a>
                </div>
            </div>
        @endcan

        
        @can('admin.admin_urgencias.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $total_admin_urgencias }}</h3>
                        <p>Administradores Urgencia</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-person"></i>
                    </div>
                    <a href="{{ url('admin/admin_urgencias') }}" class="small-box-footer">Más Información <i
                            class="fas bi bi-file-person"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.admin_enfermeros.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $total_admin_urgencias }}</h3>
                        <p>Administradores Enfermeros</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-person"></i>
                    </div>
                    <a href="{{ url('admin/admin_enfermeros') }}" class="small-box-footer">Más Información <i
                            class="fas bi bi-file-person"></i></a>
                </div>
            </div>
        @endcan
        
        
    </div>
@endsection
