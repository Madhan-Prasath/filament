<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CustomerRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create Customer permissions
        Permission::create(['name' => 'view customers',   'guard_name'  => 'web']);
        Permission::create(['name' => 'viewAny customers', 'guard_name' => 'web']);
        Permission::create(['name' => 'create customers', 'guard_name'  => 'web']);
        Permission::create(['name' => 'edit customers',   'guard_name'  => 'web']);
        Permission::create(['name' => 'delete customers', 'guard_name'  => 'web']);

        // create Customer User with default permissions
        $userrole = Role::create(['name' => 'Customer User']);
        $userrole->givePermissionTo(['view customers', 'viewAny customers', 'create customers']);
        $this->command->info('Roles and Permissions granted to Customer User');

        // create Customer Manager role with default permissions
        $managerrole = Role::create(['name' => 'Customer Manager']);
        $managerrole->givePermissionTo(['view customers', 'viewAny customers', 'create customers', 'edit customers']);
        $this->command->info('Roles and Permissions granted to Customer Manager');

        // create Customer Admin with default permissions
        $adminrole = Role::create(['name' => 'Customer Admin']);
        $adminrole->givePermissionTo(['view customers', 'viewAny customers', 'create customers', 'edit customers', 'delete customers', 'restore customers']);
        $this->command->info('Roles and Permissions granted to Customer Admin');
    }
}
