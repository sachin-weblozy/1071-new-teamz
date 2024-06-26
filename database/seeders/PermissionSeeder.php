<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::where(['name' => 'superadmin'])->first();

        $permission = Permission::create(['name' => 'Task Read']);
        $permission = Permission::create(['name' => 'Task Create']);
        $permission = Permission::create(['name' => 'Task Edit']);
        $permission = Permission::create(['name' => 'Task Delete']);

        $permission = Permission::create(['name' => 'Role Read']);
        $permission = Permission::create(['name' => 'Role Create']);
        $permission = Permission::create(['name' => 'Role Edit']);
        $permission = Permission::create(['name' => 'Role Delete']);

        $permission = Permission::create(['name' => 'Permission Read']);
        $permission = Permission::create(['name' => 'Permission Create']);
        $permission = Permission::create(['name' => 'Permission Edit']);
        $permission = Permission::create(['name' => 'Permission Delete']);

        $permission = Permission::create(['name' => 'User Read']);
        $permission = Permission::create(['name' => 'User Create']);
        $permission = Permission::create(['name' => 'User Edit']);
        $permission = Permission::create(['name' => 'User Delete']);

        $permission = Permission::create(['name' => 'Todo Read']);
        $permission = Permission::create(['name' => 'Todo Create']);
        $permission = Permission::create(['name' => 'Todo Edit']);
        $permission = Permission::create(['name' => 'Todo Delete']);

        $permission = Permission::create(['name' => 'Project Read']);
        $permission = Permission::create(['name' => 'Project Create']);
        $permission = Permission::create(['name' => 'Project Edit']);
        $permission = Permission::create(['name' => 'Project Delete']);

        $permission = Permission::create(['name' => 'Space Read']);
        $permission = Permission::create(['name' => 'Space Create']);
        $permission = Permission::create(['name' => 'Space Edit']);
        $permission = Permission::create(['name' => 'Space Delete']);

        $permission = Permission::create(['name' => 'Department Read']);
        $permission = Permission::create(['name' => 'Department Create']);
        $permission = Permission::create(['name' => 'Department Edit']);
        $permission = Permission::create(['name' => 'Department Delete']);

        $permission = Permission::create(['name' => 'Team Read']);
        $permission = Permission::create(['name' => 'Team Create']);
        $permission = Permission::create(['name' => 'Team Edit']);
        $permission = Permission::create(['name' => 'Team Delete']);

        $admin_role->givePermissionTo(Permission::all());
    }
}
