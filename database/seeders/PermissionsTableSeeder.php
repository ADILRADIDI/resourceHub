<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'view posts',
            // just premium mombre edit post
            'edit posts',
            'delete posts',
            'create posts',
            // comments
            'view comments',
            'create comments',
            // just premium mombre edit comment
            'edit comments',
            'delete comments',
            // podcast
            // just premium mombre manage podcast
            'view podcasts',
            'create podcasts',
            'edit podcasts',
            'delete podcasts',
            'suggest podcasts',
            'manage podcasts',
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
            'view settings',
            'manage tags',
            // reacted
            'manage reactions',
            // add and view and elt users
            'add users',
            'view users',
            'edit users',
            'delete users',
            'manage suggested tags',
            'view Ad',
            'manage tags',

        ];

        foreach ($permissions as $permissionName) {
            if (!Permission::where('name', $permissionName)->exists()) {
                Permission::create(['name' => $permissionName]);
            }
        }
    }
}
