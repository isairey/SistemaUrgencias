<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $rut
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero whereRut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminEnfermero whereUserId($value)
 */
	class AdminEnfermero extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $rut
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia whereRut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminUrgencia whereUserId($value)
 */
	class AdminUrgencia extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $rut
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision whereRut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admision whereUserId($value)
 */
	class Admision extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $paciente_id
 * @property int|null $categoria_id
 * @property int|null $estado_id
 * @property string $fecha_atencion
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categoria|null $categoria
 * @property-read \App\Models\Estado|null $estado
 * @property-read \App\Models\Paciente $paciente
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion whereFechaAtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Atencion whereUpdatedAt($value)
 */
	class Atencion extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $color
 * @property int $orden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Paciente> $pacientes
 * @property-read int|null $pacientes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereUpdatedAt($value)
 */
	class Categoria extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $paciente_id
 * @property int $usuario_id
 * @property string $eliminado_en
 * @property string|null $motivo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Paciente $paciente
 * @property-read \App\Models\User $usuario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente whereEliminadoEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EliminacionPaciente whereUsuarioId($value)
 */
	class EliminacionPaciente extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $rut
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero whereRut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enfermero whereUserId($value)
 */
	class Enfermero extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdminEnfermero> $adminEnfermero
 * @property-read int|null $admin_enfermero_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdminUrgencia> $adminUrgencia
 * @property-read int|null $admin_urgencia_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Admision> $admisiones
 * @property-read int|null $admisiones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Enfermero> $enfermeros
 * @property-read int|null $enfermeros_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Paciente> $pacientes
 * @property-read int|null $pacientes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usuarios
 * @property-read int|null $usuarios_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Estado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Estado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Estado query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Estado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Estado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Estado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Estado whereUpdatedAt($value)
 */
	class Estado extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $rut
 * @property string $identificacion_tipo
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $categoria_id
 * @property int|null $estado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Atencion> $atenciones
 * @property-read int|null $atenciones_count
 * @property-read \App\Models\Categoria|null $categoria
 * @property-read \App\Models\Estado|null $estado
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereIdentificacionTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereRut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente withoutTrashed()
 */
	class Paciente extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $apellido
 * @property string $rut
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdminEnfermero> $admin_enfermero
 * @property-read int|null $admin_enfermero_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdminUrgencia> $admin_urgencia
 * @property-read int|null $admin_urgencia_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Enfermero> $enfermeros
 * @property-read int|null $enfermeros_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Paciente> $pacientes
 * @property-read int|null $pacientes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

