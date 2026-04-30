<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Urgencia Adulto Categorizado</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- icono de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Sweetalert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/admin') }}" class="nav-link" data-bs-toggle="tooltip"
                        title="Página Principal">Panel Principal</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="admin" class="brand-link">
                <img src="{{ asset('assets/img/gallery/logo gobierno de chile.jpg') }}" alt="Logo Hospitales HFB"
                    class="brand-image img-circle elevation-3" style="opacity: .9">
                <span class="brand-text font-weight-light">Urgencia Adulto</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        @auth
                            <a href="#" class="d-block">{{ Auth::user()->name . ' ' . Auth::user()->apellido }}</a>
                        @else
                            <a href="#" class="d-block">Invitado</a>
                        @endauth
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        @can('admin.usuarios.index')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-people-fill"></i>
                                    <p>
                                        Usuarios
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/usuarios/create') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Creación de usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/usuarios') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('admin.admin_urgencias.index')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-people-fill"></i>
                                    <p>
                                        Admin Urgencia
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/admin_urgencias/create') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Creación de usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/admin_urgencias') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('admin.admin_enfermeros.index')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-people-fill"></i>
                                    <p>
                                        Admin Enfermeros
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/admin_enfermeros/create') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Creación de usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/admin_enfermeros') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('admin.admisiones.index')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-person-circle"></i>
                                    <p>
                                        Admisión
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/admisiones/create') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Creación de usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/admisiones') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('admin.enfermeros.index')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-person-fill-add"></i>
                                    <p>
                                        Enfermeros/as
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/enfermeros/create') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Creación Enfermeros/as</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/enfermeros') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado Enfermeros/as</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        {{-- Sección principal: Pacientes --}}
                        @can('admin.pacientes.index')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-calendar2-plus"></i>
                                    <p>
                                        Pacientes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    {{-- Crear Pacientes --}}
                                    @can('admin.pacientes.create')
                                        <li class="nav-item">
                                            <a href="{{ url('admin/pacientes/create') }}" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Creación Pacientes</p>
                                            </a>
                                        </li>
                                    @endcan

                                    {{-- Listado de Pacientes --}}
                                    <li class="nav-item">
                                        <a href="{{ url('admin/pacientes') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado Pacientes</p>
                                        </a>
                                    </li>

                                    {{-- Pacientes Ingresados --}}
                                    @can('admin.pacientes.condition')
                                        <li class="nav-item">
                                            <a href="{{ url('admin/condition') }}" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Pacientes Ingresados</p>
                                            </a>
                                        </li>
                                    @endcan

                                    {{-- Panel de Categorización --}}
                                    @can('admin.panel.index')
                                        <li class="nav-item">
                                            <a href="{{ url('admin/panel') }}" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Panel de Categorización</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan


                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" style="background-color: #a9200e"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas bi bi-door-closed"></i>
                                <p>
                                    Cerrar Sesión
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        @if (($message = Session::get('mensaje')) && ($icono = session::get('icono')))
            <script>
                Swal.fire({
                    position: "center",
                    icon: "{{ $icono }}",
                    title: "{{ $message }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif

        <div class="content-wrapper">
            <br>
            <div class="container">
                @yield('content')
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Bootstrap JS (versión 5.x) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
    <!-- iconos tooltips -->
    <script>
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>



    <div id="global-spinner" class="spinner-border text-primary" role="status"
        style="display: none; 
            width: 4rem; height: 4rem; 
            position: fixed; top: 50%; 
            left: 50%; margin-left: -2rem; 
            margin-top: -2rem; z-index: 9998;
            ">
        <span class="visually-hidden"></span>
    </div>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                const color = $(this).data('spinner-color') || 'primary';
                $('#global-spinner')
                    .removeClass() // limpia cualquier clase previa
                    .addClass(`spinner-border text-${color}`)
                    .show();

                $('#blur-overlay').show();
            });

            // Spinner al hacer clic en botón Cancelar (independiente del formulario)
            $('.cancel-btn').on('click', function() {
                $('#blur-overlay').show();
                $('#global-spinner')
                    .removeClass()
                    .addClass('spinner-border text-secondary') // gris para cancelar
                    .show();
            });

            // Spinner al hacer clic en botones de acción (ver, editar, eliminar)
            $('.action-btn').on('click', function() {
                $('#blur-overlay').show();

                let btnColor = 'info'; // color por defecto
                if ($(this).hasClass('btn-success')) btnColor = 'success';
                if ($(this).hasClass('btn-danger')) btnColor = 'danger';

                $('#global-spinner')
                    .removeClass()
                    .addClass(`spinner-border text-${btnColor}`)
                    .show();
            });

            // Spinner al hacer clic en agregar nuevos ingresos
            $('.access-btn').on('click', function() {
                $('#blur-overlay').show();

                let btnColor = 'primary'; // color por defecto
                if ($(this).hasClass('btn-success')) btnColor = 'success';
                if ($(this).hasClass('btn-danger')) btnColor = 'danger';

                $('#global-spinner')
                    .removeClass()
                    .addClass(`spinner-border text-${btnColor}`)
                    .show();
            });

            //Sprinner al crear una nueva atencion rápida
            $('.btn-confirmar').on('click', function() {
                $('#blur-overlay').show();

                let btnColor = 'primary'; // color por defecto
                if ($(this).hasClass('btn-success')) btnColor = 'success';
                if ($(this).hasClass('btn-danger')) btnColor = 'danger';

                $('#global-spinner')
                    .removeClass()
                    .addClass(`spinner-border text-${btnColor}`)
                    .show();
            });

        });
    </script>

    @stack('scripts')
</body>

</html>
