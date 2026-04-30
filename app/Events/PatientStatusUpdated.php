<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;


class PatientStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $categoriaCodigo;
    public string $categoriaNombre;
    public string $estadoNombre;
    public ?string $estadoAnteriorNombre;
    public int $cantidad;

    public function __construct(string $categoriaCodigo, string $categoriaNombre, string $estadoNombre, ?string $estadoAnteriorNombre, int $cantidad)
    {
        $this->categoriaCodigo = $categoriaCodigo;
        $this->categoriaNombre = $categoriaNombre;
        $this->estadoNombre = $estadoNombre;
        $this->estadoAnteriorNombre = $estadoAnteriorNombre;
        $this->cantidad = $cantidad;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('panel-pacientes'),
            new Channel('categoria.' . Str::slug($this->categoriaCodigo)), // Canal específico por categoría
            new Channel('estado.' . Str::slug($this->estadoNombre)), // Canal específico por estado
        ];
        
    }

    public function broadcastAs()
    {
        return 'PatientStatusUpdated';
    }

    public function broadcastWith(): array
    {
        $slugify = fn($text) => strtolower(str_replace(' ', '-', $text));

        return [
            'categoria_codigo' => Str::slug($this->categoriaCodigo),
            'categoria_nombre' => $this->categoriaNombre,
            'estado_nombre' => $this->estadoNombre,
            'estado_anterior_nombre' => $this->estadoAnteriorNombre,
            'cantidad' => $this->cantidad,
        ];
    }
}