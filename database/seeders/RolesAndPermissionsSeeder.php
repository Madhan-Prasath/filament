<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create Permission permissions
        Permission::create(['name' => 'view permissions',    'guard_name' => 'web']);
        Permission::create(['name' => 'viewAny permissions', 'guard_name' => 'web']);
        Permission::create(['name' => 'create permissions',  'guard_name' => 'web']);
        Permission::create(['name' => 'edit permissions',    'guard_name' => 'web']);
        Permission::create(['name' => 'delete permissions',  'guard_name' => 'web']);

        // create Role permissions
        Permission::create(['name' => 'view roles',     'guard_name' => 'web']);
        Permission::create(['name' => 'viewAny roles',  'guard_name' => 'web']);
        Permission::create(['name' => 'create roles',   'guard_name' => 'web']);
        Permission::create(['name' => 'edit roles',     'guard_name' => 'web']);
        Permission::create(['name' => 'delete roles',   'guard_name' => 'web']);

        // create User permissions
        Permission::create(['name' => 'view users',   'guard_name'  => 'web']);
        Permission::create(['name' => 'viewAny users', 'guard_name' => 'web']);
        Permission::create(['name' => 'create users', 'guard_name'  => 'web']);
        Permission::create(['name' => 'edit users',   'guard_name'  => 'web']);
        Permission::create(['name' => 'delete users', 'guard_name'  => 'web']);

        // create User User with default permissions
        $userrole = Role::create(['name' => 'User User']);
        $userrole->givePermissionTo(['view users', 'viewAny users', 'create users']);
        $this->command->info('Roles and Permissions granted to User User');

        // create User Manager role with default permissions
        $managerrole = Role::create(['name' => 'User Manager']);
        $managerrole->givePermissionTo(['view users', 'viewAny users', 'create users', 'edit users']);
        $this->command->info('Roles and Permissions granted to User Manager');

        // create User Admin with default permissions
        $adminrole = Role::create(['name' => 'User Admin']);
        $adminrole->givePermissionTo(['view users', 'viewAny users', 'create users', 'edit users', 'delete users']);
        $this->command->info('Roles and Permissions granted to User Admin');

        // create Role User with default permissions
        $userrole = Role::create(['name' => 'Role User']);
        $userrole->givePermissionTo(['view roles', 'viewAny roles', 'create roles']);
        $this->command->info('Roles and Permissions granted to Role User');

        // create Role Manager role with default permissions
        $managerrole = Role::create(['name' => 'Role Manager']);
        $managerrole->givePermissionTo(['view roles', 'viewAny roles', 'create roles', 'edit roles']);
        $this->command->info('Roles and Permissions granted to Role Manager');

        // create Role Admin with default permissions
        $adminrole = Role::create(['name' => 'Role Admin']);
        $adminrole->givePermissionTo(['view roles', 'viewAny roles', 'create roles', 'edit roles', 'delete roles']);
        $this->command->info('Roles and Permissions granted to Role Admin');

        // create Permission User with default permissions
        $userPermission = Role::create(['name' => 'Permission User']);
        $userPermission->givePermissionTo(['view permissions', 'viewAny permissions', 'create permissions']);
        $this->command->info('permissions and Permissions granted to Permission User');

        // create Permission Manager Permission with default permissions
        $managerPermission = Role::create(['name' => 'Permission Manager']);
        $managerPermission->givePermissionTo(['view permissions', 'viewAny permissions', 'create permissions', 'edit permissions']);
        $this->command->info('permissions and Permissions granted to Permission Manager');

        // create Permission Admin with default permissions
        $adminPermission = Role::create(['name' => 'Permission Admin']);
        $adminPermission->givePermissionTo(['view permissions', 'viewAny permissions', 'create permissions', 'edit permissions', 'delete permissions']);
        $this->command->info('permissions and Permissions granted to Permission Admin');

        // User Role
        $user_role  = Role::create(['name' => 'User']);

        // Grant Super Admin rights to SUPER_ADMIN_EMAIL
        $adminEmail = env('SUPER_ADMIN_EMAIL', null);
        if (is_null($adminEmail)) {
            throw new \InvalidArgumentException('SUPER_ADMIN_EMAIL cannot be empty!');
        }
        $user = User::whereEmail($adminEmail)->first();
        if (is_null($user)) {
            throw new \InvalidArgumentException('User cannot be empty!');
        }
        $role = Role::create(['name' => 'Super Admin']);
        $user->assignRole('Super Admin');
        $this->command->info('Super Admin Role created successfully.');
    }
}
