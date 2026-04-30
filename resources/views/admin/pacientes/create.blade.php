@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Registro de pacientes</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Completar los datos</h3>
                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <form id="form-paciente" action="{{ route('admin.pacientes.store') }}" method="POST"
                        data-spinner-color="primary">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="identificacionti_tipo">Tipo de Identificación</label>
                                    <div>
                                        <label style="margin-right: 15px;">
                                            <input type="radio" name="identificacion_tipo" value="rut" checked> Rut
                                        </label>
                                        <label style="margin-right: 15px;">
                                            <input type="radio" name="identificacion_tipo" value="pasaporte"> Pasaporte
                                        </label>
                                        <label>
                                            <input type="radio" name="identificacion_tipo" value="ficha"> N° Registro
                                        </label>
                                    </div>
                                </div>

                                <div class="form group">
                                    <label for="rut">Identificación</label> <b>*</b>
                                    <input type="text" name="rut" id="rut" class="form-control"
                                        value="{{ old('identificacion') }}" required>
                                    <small id="rut-error" style="color:red; display:none;">RUT inválido</small>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Nombre</label> <b>*</b>
                                    <input type="text" value="{{ old('nombre') }}" name="nombre" class="form-control"
                                        required>
                                    @error('nombre')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Apellido</label> <b>*</b>
                                    <input type="text" value="{{ old('apellido') }}" name="apellido" class="form-control"
                                        required>
                                    @error('apellido')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{ url('admin/pacientes') }}" class="btn btn-secondary cancel-btn">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-floppy"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    @if (session('paciente_existente'))
                        
                        @php $paciente = session('paciente_existente'); @endphp
                        @php $atencion = $paciente->atenciones->last(); @endphp
                        @php $estado = $paciente->estado->nombre ?? 'sin estado'; @endphp

                        <script>
                            //define una variable js con el estado del paciente para usarla en las condiciones
                            const estadoPaciente = "{{ $estado }}";
                            //me muestra un modal de advertencia indicando que el paciente tiene una atencion activa
                            if (['Ingresado', 'En espera de atencion', 'En atencion', 'En espera de cama'].includes(estadoPaciente)) {
                                // Modal de paciente con atención activa
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Paciente con atención activa',
                                    html: `
                            <div style="text-align:center;">
                                <strong>Nombre:</strong> {{ $paciente->nombre }} {{ $paciente->apellido }}<br>
                                <strong>RUT:</strong> {{ $paciente->rut }}<br>
                                <strong>Estado actual:</strong> {{ $estado }}<br><br>
                                Este paciente ya tiene una atención activa.<br>
                                No se puede registrar una nueva atención hasta que sea dado de alta.
                            </div>
                        `,
                                    confirmButtonText: 'Entendido',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                });
                                //muestra el modal con los datos del paciente y 3 botones
                            } else {
                                // Modal de paciente disponible
                                Swal.fire({
                                    title: 'Paciente ya registrado',
                                    icon: 'info',
                                    html: `
                            <div style="text-align:center;">
                                <strong>Nombre:</strong> {{ $paciente->nombre }} {{ $paciente->apellido }}<br>
                                <strong>RUT:</strong> {{ $paciente->rut }}<br>
                                <strong>Última atención:</strong> {{ optional($atencion->categoria)->nombre ?? 'sin categorizar' }}<br>
                                <strong>Total de atenciones:</strong> {{ $paciente->atenciones->count() }}<br><br>
                                <div style="display: flex; gap: 8px; justify-content: center; margin-top: 10px;">
                                    <button id="btn-confirmar" style="background-color:#28a745; color:white; padding:6px 12px; border:none; border-radius:4px;">Agregar nueva atención</button>
                                    <button id="btn-cancelar" style="background-color:#6c757d; color:white; padding:6px 12px; border:none; border-radius:4px;">Cancelar</button>
                                    <button id="btn-editar" style="background-color:#EDE505; color:white; padding:6px 12px; border:none; border-radius:4px;">Editar datos</button>
                                </div>
                            </div>
                        `,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                });

                                // Eventos de botones
                                document.addEventListener('click', function(e) {
                                    if (e.target.id === 'btn-confirmar') {
                                        //spinner de carga
                                        $('#blur-overlay').show();
                                        $('#global-spinner')
                                            .removeClass()
                                            .addClass('spinner-border text-success') 
                                            .show();

                                        //envia una solicitud fetch para registrar una nueva atencion para el paciente en mi ruta 
                                        fetch("{{ route('admin.pacientes.atencionRapida', $paciente->id) }}", {
                                                method: 'POST',
                                                //incluye el token CSRF en los encabezados para que laravel lo valide
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                //puede enviar datos si lo necesita, en este caso no es necesario
                                                body: JSON.stringify({})
                                            })
                                            //maneja la respuesta y redirige al panel de pacientes
                                            .then(response => {
                                                if (!response.ok) {
                                                    throw new Error('Error al registrar la atención');
                                                }
                                                return response.text(); // o .json() si devuelves JSON
                                            })
                                            .then(() => {
                                                Swal.fire({
                                                    title: 'Atención registrada',
                                                    icon: 'success',
                                                    timer: 1500,
                                                    showConfirmButton: false
                                                }).then(() => {
                                                    window.location.href = "{{ route('admin.pacientes.index') }}";
                                                });
                                            })
                                            //muestra un error si algo falla 
                                            .catch(error => {
                                                //carga oculta de spinner
                                                $('#blur-overlay').hide();
                                                $('#global-spinner').hide();

                                                Swal.fire({
                                                    title: 'Error',
                                                    text: error.message,
                                                    icon: 'error'
                                                });
                                            });
                                    }
                                    if (e.target.id === 'btn-cancelar') {
                                        Swal.close();
                                    }
                                    if (e.target.id === 'btn-editar') {
                                        Swal.fire({
                                            title: 'Editar datos del paciente',
                                            html: `
                                    <input type="text" id="nuevo-nombre" value="{{ $paciente->nombre }}" class="form-control mb-2" placeholder="Nombre" required>
                                    <input type="text" id="nuevo-apellido" value="{{ $paciente->apellido }}" class="form-control mb-2" placeholder="Apellido" required>
                                `,
                                            showConfirmButton: true,
                                            confirmButtonText: 'Guardar cambios',
                                            showCancelButton: true,
                                            cancelButtonText: 'Cancelar',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            preConfirm: () => {
                                                const nombre = document.getElementById('nuevo-nombre').value;
                                                const apellido = document.getElementById('nuevo-apellido').value;

                                                return fetch(
                                                        "{{ route('admin.pacientes.actualizarDatos', $paciente->id) }}", {
                                                            method: 'PUT',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                            },
                                                            body: JSON.stringify({
                                                                nombre,
                                                                apellido
                                                            })
                                                        })
                                                    .then(response => {
                                                        if (!response.ok) {
                                                            throw new Error('Error al guardar los datos');
                                                        }
                                                        return response.json();
                                                    })
                                                    .catch(error => {
                                                        Swal.showValidationMessage(`Error: ${error}`);
                                                    });
                                            }
                                        }).then(result => {
                                            //muestra confirmacion de datos actualizados
                                            if (result.isConfirmed) {
                                                Swal.fire({
                                                    title: 'Datos actualizados',
                                                    icon: 'success',
                                                    timer: 1500,
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false,
                                                    allowEscapeKey: false
                                                }).then(() => {
                                                    mostrarModalAtencion(result.value.paciente);
                                                });
                                            }
                                            if (result.dismiss === Swal.DismissReason.cancel) {
                                                mostrarModalAtencion(@json($paciente));
                                            }
                                        });
                                    }
                                });

                                // Función para mostrar modal principal luego de edición
                                function mostrarModalAtencion(paciente) {
                                    Swal.fire({
                                        title: 'Paciente ya registrado',
                                        icon: 'info',
                                        html: `
                                <div style="text-align:center;">
                                    <strong>Nombre:</strong> ${paciente.nombre} ${paciente.apellido}<br>
                                    <strong>RUT:</strong> ${paciente.rut}<br>
                                    <strong>Última atención:</strong> ${paciente.ultima_categoria ?? 'sin categorizar'}<br>
                                    <strong>Total de atenciones:</strong> ${paciente.total_atenciones}<br><br>
                                    <div style="display: flex; gap: 8px; justify-content: center; margin-top: 10px;">
                                        <button id="btn-confirmar" style="background-color:#28a745; color:white; padding:6px 12px; border:none; border-radius:4px;">Agregar nueva atención</button>
                                        <button id="btn-cancelar" style="background-color:#6c757d; color:white; padding:6px 12px; border:none; border-radius:4px;">Cancelar</button>
                                        <button id="btn-editar" style="background-color:#EDE505; color:white; padding:6px 12px; border:none; border-radius:4px;">Editar datos</button>
                                    </div>
                                </div>
                            `,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    });
                                }
                            }
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function validarRut(rut) {
        rut = rut.replace(/\./g, '').replace('-', '');
        if (rut.length < 2) return false;

        const cuerpo = rut.slice(0, -1);
        const dv = rut.slice(-1).toUpperCase();

        let suma = 0;
        let multiplo = 2;

        for (let i = cuerpo.length - 1; i >= 0; i--) {
            suma += multiplo * parseInt(cuerpo.charAt(i));
            multiplo = multiplo < 7 ? multiplo + 1 : 2;
        }

        const dvEsperado = 11 - (suma % 11);
        const dvCalc = dvEsperado === 11 ? '0' : dvEsperado === 10 ? 'K' : dvEsperado.toString();

        return dv === dvCalc;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const rutInput = document.getElementById('rut');
        const errorSpan = document.getElementById('rut-error');

        rutInput.addEventListener('input', function() {
            const tipo = document.querySelector('input[name="identificacion_tipo"]:checked').value;
            if (tipo === 'rut') {
                if (!validarRut(rutInput.value)) {
                    errorSpan.style.display = 'block';
                    rutInput.classList.add('is-invalid');
                } else {
                    errorSpan.style.display = 'none';
                    rutInput.classList.remove('is-invalid');
                }
            } else {
                errorSpan.style.display = 'none';
                rutInput.classList.remove('is-invalid');
            }
        });

        document.querySelectorAll('input[name="identificacion_tipo"]').forEach(radio => {
            radio.addEventListener('change', () => {
                errorSpan.style.display = 'none';
                rutInput.classList.remove('is-invalid');
            });
        });
    });
</script>
