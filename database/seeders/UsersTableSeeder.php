<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        $superadmin = User::updateOrCreate(
            ['email' => 'admin@example.com'], 
            [
                'name' => 'Admin User',
                'password' => bcrypt('password123'),
            ]
        );
        $superadmin->assignRole('super-admin');

        // Create a regular user
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('password123'),
            ]
        );
        $user->assignRole('user');

        // Assign permissions to roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo([
            'view posts',
            'edit posts',
            'delete posts',
            'create posts',
            'manage users',
            'manage ads',
            'view analytics'
        ]);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo(['view posts']);
    }
}
