<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeed extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting Roles and Permissions seeding...');

        /*
        |--------------------------------------------------------------------------
        | Clear permission cache
        |--------------------------------------------------------------------------
        */

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Permission cache cleared.');

        /*
        |--------------------------------------------------------------------------
        | Create Roles
        |--------------------------------------------------------------------------
        */

        $roles = [
            'admin',
            'supervisor',
            'user',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
            $this->command->info("Role created or already exists: {$role}");
        }

        /*
        |--------------------------------------------------------------------------
        | Create Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // Traffic Reports
            'traffic_reports.view',
            'traffic_reports.view_any',
            'traffic_reports.create',
            'traffic_reports.update',
            'traffic_reports.validate',
            'traffic_reports.delete',

            // Users
            'users.view',
            'users.view_any',
            'users.create',
            'users.update',
            'users.delete',

            // Violations
            'violations.view',
            'violations.view_any',
            'violations.create',
            'violations.update',
            'violations.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $this->command->info("Permission created or already exists: {$permission}");
        }

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions to Roles
        |--------------------------------------------------------------------------
        */

        $admin = Role::findByName('admin');
        $supervisor = Role::findByName('supervisor');
        $user = Role::findByName('user');


        $admin->syncPermissions([
            'traffic_reports.view',
            'traffic_reports.view_any',
            //'traffic_reports.create',
            //'traffic_reports.update',
            'traffic_reports.validate',
            'traffic_reports.delete',

            // Users
            'users.view',
            'users.view_any',
            'users.create',
            'users.update',
            'users.delete',

            // Violations
            'violations.view',
            'violations.view_any',
            'violations.create',
            'violations.update',
            'violations.delete',
        ]);
        $this->command->info('Permissions assigned to role: admin');

        $supervisor->syncPermissions([
            'traffic_reports.view',
            'traffic_reports.view_any',
            'traffic_reports.update',
            'traffic_reports.validate',
        ]);
        $this->command->info('Permissions assigned to role: supervisor');

        $user->syncPermissions([
            'traffic_reports.create',
            'traffic_reports.view',
            'traffic_reports.view_any',
        ]);
        $this->command->info('Permissions assigned to role: user');

        $this->command->info('Roles and Permissions seeding completed successfully.');
    }
}
