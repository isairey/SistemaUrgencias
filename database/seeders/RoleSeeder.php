<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        //Seeder para roles y permisos
        $administrador = Role::create(['name'=>'admin']);
        $admision = Role::create(['name'=>'admisionista']);
        $enfermero = Role::create(['name'=>'enfermero']);
        $adminUrgencia = Role::create(['name'=>'administrador_urgencia']);
        $adminEnfermero = Role::create(['name'=>'administrador_enfermero']);

        //Rutas para el administrador
        Permission::create(['name' => 'admin.index']);
        
        //Rutas para el administrador - usuarios admisiones
        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.store'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.show'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.edit'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.update'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles([$administrador]);

        //Rutas para el administrador - usuarios admin_urgencias
        Permission::create(['name' => 'admin.admin_urgencias.index'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_urgencias.create'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_urgencias.store'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_urgencias.show'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_urgencias.edit'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_urgencias.update'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_urgencias.confirmDelete'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_urgencias.destroy'])->syncRoles([$administrador]);

        //Rutas para el administrador - usuarios admin_enfermeros
        Permission::create(['name' => 'admin.admin_enfermeros.index'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_enfermeros.create'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_enfermeros.store'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_enfermeros.show'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_enfermeros.edit'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_enfermeros.update'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_enfermeros.confirmDelete'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.admin_enfermeros.destroy'])->syncRoles([$administrador]);

        //Rutas para el administrador - usuarios admisiones
        Permission::create(['name' => 'admin.admisiones.index'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.admisiones.create'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.admisiones.store'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.admisiones.show'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.admisiones.edit'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.admisiones.update'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.admisiones.confirmDelete'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.admisiones.destroy'])->syncRoles([$administrador, $adminUrgencia]);

        //Rutas para el administrador - usuarios enfermeros
        Permission::create(['name' => 'admin.enfermeros.index'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.enfermeros.create'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.enfermeros.store'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.enfermeros.show'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.enfermeros.edit'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.enfermeros.update'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.enfermeros.confirmDelete'])->syncRoles([$administrador, $adminUrgencia]);
        Permission::create(['name' => 'admin.enfermeros.destroy'])->syncRoles([$administrador, $adminUrgencia]);

        //Rutas para el administrador - usuarios pacientes
        Permission::create(['name' => 'admin.pacientes.index'])->syncRoles([$administrador, $admision, $enfermero, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.create'])->syncRoles([$administrador, $admision, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.store'])->syncRoles([$administrador, $admision, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.show'])->syncRoles([$administrador, $enfermero, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.edit'])->syncRoles([$administrador, $admision, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.update'])->syncRoles([$administrador, $enfermero, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.confirmDelete'])->syncRoles([$administrador, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.destroy'])->syncRoles([$administrador, $enfermero, $adminUrgencia, $adminEnfermero]);

        //Rutas para el administrador - EstadoPaciente
        Permission::create(['name' => 'admin.atenciones.create'])->syncRoles([$administrador, $admision, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.atenciones.store'])->syncRoles([$administrador, $admision, $adminUrgencia, $adminEnfermero]);

        //Rutas para el administrador - EstadoPaciente

        Permission::create(['name' => 'admin.pacientes.condition'])->syncRoles([$administrador, $enfermero, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.pacientes.updateCategory'])->syncRoles([$administrador, $enfermero, $adminUrgencia, $adminEnfermero]);
        Permission::create(['name' => 'admin.panel.index'])->syncRoles([$administrador, $admision, $enfermero, $adminUrgencia, $adminEnfermero]);
    }
}
