<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // super admin 
        $superadmin_role = Role::create(['name' => 'superadmin']);
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@weblozy.com',
            'phone' => '9876543210',
            // 'department_code' => '101',
            'password' => bcrypt('passw0rd')
        ]);
        $superadmin->assignRole($superadmin_role);
        
        $user_role = Role::create(['name' => 'user']);
        // $user = User::create([
        //     'name' => 'User',
        //     'email' => 'sachin10157@weblozy.in',
        //     'phone' => '9876543213',
        //     'password' => bcrypt('password')
        // ]);
        // $user->assignRole($user_role);
    }
}
