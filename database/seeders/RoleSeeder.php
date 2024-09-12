<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * se crea los  permisos a los usuario 
     */
    public function run(): void
    {   
        // creacion de los productos 
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'customer']);

        // creacion de los permisos 
        Permission::firstOrCreate(['name' => 'manage.products']);
        Permission::firstOrCreate(['name' => 'manage.customers']);
        
        // asignacion de permisos a los roles
        $role1->givePermissionTo('manage.products');
        $role2->givePermissionTo('manage.customers');

    }
}
