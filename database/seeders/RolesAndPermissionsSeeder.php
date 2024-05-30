<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Project Manager']);
        Role::create(['name' => 'Team Member']);
        
        Permission::create(['name' => 'manage projects']);
        Permission::create(['name' => 'manage tasks']);
        
        $adminRole = Role::findByName('Admin');
        $adminRole->givePermissionTo(Permission::all());

        $projectManagerRole = Role::findByName('Project Manager');
        $projectManagerRole->givePermissionTo(['manage projects', 'manage tasks']);
    }
}
