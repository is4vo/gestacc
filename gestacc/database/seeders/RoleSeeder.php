<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Miembro']);
        $rol3 = Role::create(['name' => 'Invitado']);

        Permission::create(['name' => 'usuarios'])->assignRole($rol1);
        Permission::create(['name' => 'nuevaActa'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'actasPendientes'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'tareas'])->syncRoles([$rol1, $rol2, $rol3]);
        Permission::create(['name' => 'reunion'])->syncRoles([$rol1, $rol2]);
    }
}
