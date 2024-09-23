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
            'manage ads',
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
            'create events',
            'edit events',
            'delete events',
            'view events',
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
            'suggest podcasts',
            'manage podcasts',
            'manage tags',
            'manage suggested tags',
            'manage ads',
            'view Ad',
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'view comments',
            'create comments',
            'delete comments',
        ]);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo(['view posts',
                                    'view users',
                                    'view bookmarks',
                                    'view yt channels',
                                    'view bookmarks',
                                    'create bookmarks',
                                    'delete bookmarks',
                                    'view podcasts',
                                    'create podcasts',
                                    'suggest podcasts',
                                    'view events',
                                    'register events',
                                    'view yt channels',
                                    'create yt channels',
                                    'manage tags',
                                    'manage suggested tags',
                                    'view Ad',
                                    'view posts',
                                    'create posts',
                                    'edit posts',
                                    'delete posts',
                                    'view comments',
                                    'create comments',
                                    'delete comments',


    ]);
    }
}
