@extends('layouts.admin')

@section('content')
    <div class="row mb-4">
        <h2 class="mb-3">Tiempo de Espera para Atención</h2>

        @if($hayCriticos)
            <div class="alert alert-warning text-center">
                <h2>Pacientes ESI 1 presentes. Umbrales de espera ajustados dinámicamente.</h2>
            </div>
        @endif

        <div class="row mb-3">
        @foreach ($categorias as $categoria)
            @php
                $ocupacion = $categoria['cupo'] > 0 ? ($categoria['total'] / $categoria['cupo']) * 100 : 0;
                $ocupacionColor = $ocupacion > 100 ? 'danger' : 'light';
            @endphp
            <div class="col-md-2">
                <div class="card text-center bg-{{ $categoria['color'] }} text-white">
                    <div class="card-body p-2">
                        <strong class="fs-5">{{ $categoria['codigo'] }}</strong><br>
                        <span style="font-size: 4em;">
                            {{ $categoria['total'] }} / {{ $categoria['cupo'] }}
                        </span>
                        @if($ocupacion > 100)
                            <div class="mt-1 badge bg-danger"> Sobre capacidad</div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Panel detallado por estados -->
    <div class="row" id="panel-categorias">
        @foreach ($categorias as $categoria)
            <div class="col-md-4 mb-4">
                <div class="card border-{{ $categoria['color'] }}" data-categoria="{{ $categoria['codigo'] }}">

                    <!-- Card Header -->
                    <div class="card-header text-white bg-{{ $categoria['color'] }}">
                        <strong>{{ $categoria['codigo'] . ' - ' . $categoria['nombre'] }}</strong>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body bg-white">
                        <div class="row">
                            @foreach ($categoria['estados'] as $estadoNombre => $estadoData)
                                @php
                                    $estadoSlug = \Illuminate\Support\Str::slug($estadoNombre);
                                    $espera = $estadoData['promedio'];
                                    $umbral = $categoria['umbrales'];
                                    $color = $espera > $umbral ? 'danger' : ($espera > ($umbral * 0.7) ? 'warning' : 'success');
                                @endphp

                                <div class="col-md-12 mb-3">
                                    <div class="info-box border border-{{ $categoria['color'] }} bg-white text-dark{{ $categoria['color'] }}"
                                        id="card-{{ Str::slug($categoria['codigo']) }}-{{ $estadoSlug }}">

                                        <span class="info-box-icon border-end border-{{ $categoria['color'] }} bg-white text-{{ $categoria['color'] }}">
                                            <i class="{{ $estadoData['icono'] }}"></i>
                                        </span>

                                        <div class="info-box-content">
                                            <span class="info-box-text fw-bold text-uppercase fw-semibold fs-4">{{ $estadoNombre }}</span>
                                            <span class="info-box-number cantidad-{{ $estadoSlug }} contador fs-3">
                                                {{ $estadoData['cantidad'] }} pacientes
                                            </span>

                                            <span class="fs-5 text-{{ $color }}">{{ $espera }} min</span>

                                            <div class="progress mt-2">
                                                <div class="progress-bar bg-{{ $categoria['color'] }}"
                                                    style="width: {{ min($espera * 2, 100) }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection



@section('scripts')
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log(" Panel cargado, escuchando eventos...");

            // Función para actualizar un estado específico
            function actualizarCard(e) {
                const estadoSlug = e.estado_nombre.replace(/\s+/g, '-').toLowerCase();
                const cardId = `card-${e.categoria_codigo}-${estadoSlug}`;
                console.log("🔍 Buscando card:", cardId);
                const card = document.getElementById(cardId);
                if (card) {
                    let contador = card.querySelector('.contador');
                    if (contador) {
                        contador.textContent = `${e.cantidad} pacientes`;
                    }
                    console.log("Actualizada card:", cardId);
                } else {
                    console.warn("No se encontró la card con ID:", cardId);
                }
            }

        });

        //Recarga parcial cada 30 segundos
        setTimeout(() => {
        if (typeof window.Echo === 'undefined') {
            console.warn("Echo no está disponible, usando recarga por intervalo...");
            setInterval(() => {
                console.log(" Actualizando panel automáticamente...");
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        const nuevoPanel = tempDiv.querySelector('#panel-categorias');
                        if (nuevoPanel) {
                            document.querySelector('#panel-categorias').innerHTML =
                                nuevoPanel.innerHTML;
                        }
                    });
            }, 10000);
        }
        }, 1000); // Espera 1 segundo para dar tiempo a que Echo se cargue
        });
    </script>
@endsection
