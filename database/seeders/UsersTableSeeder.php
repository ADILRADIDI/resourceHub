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
        $superadmin = User::updateOrCreate(
            ['email' => 'adulradidi@gmail.com'], 
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
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
            // just premium mombre edit post
            'edit posts',
            'delete posts',
            'create posts',
            // comments
            'view comments',
            // just premium mombre edit comment
            'edit comments',
            'delete comments',
            // podcast
            'view podcasts',
            'create podcasts',
            'edit podcasts',
            'delete podcasts',
            // yt channels
            'view yt channels',
            'create yt channels',
            'edit yt channels',
            'delete yt channels',
            // events
            'view events',
            'create events',
            'edit events',
            'delete events',
            'register events',
            // search in yt and watch
            'search in yt',
            'watch yt videos',
            // bookmarks
            'view bookmarks',
            'create bookmarks',
            'delete bookmarks',
            'manage users',
            'manage ads',
            'view analytics',
            'create comments',
            'view settings',
            'manage tags',
            'manage reactions',
            'add users',
            'view users',
            'edit users',
            'delete users',
        ]);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo(['view posts']);
    }
}
