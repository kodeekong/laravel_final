<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create permissions
        Permission::firstOrCreate(['name' => 'view missed activities']);

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);

        // Assign permissions to roles
        $adminRole->givePermissionTo('view missed activities');
        $supervisorRole->givePermissionTo('view missed activities');

        // Create users and assign roles
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], 
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );
        $adminUser->assignRole($adminRole);

        $supervisorUser = User::firstOrCreate(
            ['email' => 'supervisor@example.com'], 
            ['name' => 'Supervisor User', 'password' => bcrypt('password')]
        );
        $supervisorUser->assignRole($supervisorRole);
    }
}
