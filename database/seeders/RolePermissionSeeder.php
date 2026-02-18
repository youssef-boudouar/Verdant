<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $resources = [
            'products',
            'users',
        ];

        // Generate permissions
        $permissions = [];
        foreach ($resources as $resource) {
            $permissions[] = "view $resource";
            $permissions[] = "create $resource";
            $permissions[] = "edit $resource";
            $permissions[] = "delete $resource";
        }

        // Add custom permissions
        $permissions[] = 'manage favorites';

        // Create permissions in database
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin role
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Create client role
        $client = Role::create(['name' => 'client']);
        $client->givePermissionTo([
            'view products',
            'manage favorites',
        ]);
    }
}
