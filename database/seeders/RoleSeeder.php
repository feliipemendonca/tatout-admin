<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

     
        $arrayOfPermissionNames = [

            /** USERS */
            'user.list',
            'user.create',
            'user.edit',
            'user.destroy',

            /** COMPANY */
            'company.list',
            'company.create',
            'company.edit',
            'company.destroy',

            /** PRODUCTS */
            'product.list',
            'product.create',
            'product.edit',
            'product.destroy',

            /** TYPEPRODUCTS */
            'typeproduct.list',
            'typeproduct.create',
            'typeproduct.edit',
            'typeproduct.destroy',

            /** PRODUCTSPRICE */
            'productprice.list',
            'productprice.create',
            'productprice.edit',
            'productprice.destroy',

            /** AVAILABILITY */
            'availability.list',
            'availability.create',
            'availability.edit',
            'availability.destroy',

            /** ROLES */
            'role.list',
            'role.create',
            'role.edit',
            'role.destroy',

            /** PERMISSION */
            'permission.list',
            'permission.create',
            'permission.edit',
            'permission.destroy',

        ];

        $giveMaster = [
            /** USERS */
            'user.list',
            'user.create',
            'user.edit',
            'user.destroy',

            /** COMPANY */
            'company.list',
            'company.create',
            'company.edit',
            'company.destroy',

            /** PRODUCTS */
            'product.list',
            'product.create',
            'product.edit',
            'product.destroy',

            /** TYPEPRODUCTS */
            'typeproduct.list',
            'typeproduct.create',
            'typeproduct.edit',
            'typeproduct.destroy',

            /** PRODUCTSPRICE */
            'productprice.list',
            'productprice.create',
            'productprice.edit',
            'productprice.destroy',

            /** AVAILABILITY */
            'availability.list',
            'availability.create',
            'availability.edit',
            'availability.destroy',

            /** ROLES */
            'role.list',
            'role.create',
            'role.edit',
            'role.destroy',

            /** PERMISSION */
            'permission.list',
            'permission.create',
            'permission.edit',
            'permission.destroy',
        ];

        $giveAdmin = [
            /** USERS */
            'user.list',
            'user.create',
            'user.edit',
            'user.destroy',

            /** COMPANY */
            'company.list',
            'company.create',
            'company.edit',
            'company.destroy',

            /** PRODUCTS */
            'product.list',
            'product.create',
            'product.edit',
            'product.destroy',

            /** TYPEPRODUCTS */
            'typeproduct.list',
            'typeproduct.create',
            'typeproduct.edit',
            'typeproduct.destroy',

            /** PRODUCTSPRICE */
            'productprice.list',
            'productprice.create',
            'productprice.edit',
            'productprice.destroy',

            /** AVAILABILITY */
            'availability.list',
            'availability.create',
            'availability.edit',
            'availability.destroy',
        ];

        $giveCompany = [
            /** USERS */
            'user.list',
            'user.create',
            'user.edit',
            'user.destroy',

            /** PRODUCTS */
            'product.list',
            'product.create',
            'product.edit',
            'product.destroy',

            /** PRODUCTSPRICE */
            'productprice.list',
            'productprice.create',
            'productprice.edit',
            'productprice.destroy',

            /** AVAILABILITY */
            'availability.list',
            'availability.create',
            'availability.edit',
            'availability.destroy',
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());


        Role::create(['name' => 'master'])
            ->givePermissionTo($giveMaster);

        Role::create(['name' => 'admin'])
            ->givePermissionTo($giveAdmin);

        Role::create(['name' => 'company'])
            ->givePermissionTo($giveCompany);

        Role::create(['name' => 'seller'])
            ->givePermissionTo($giveCompany);


        User::create([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
            'password' => '123123',
            'status_id' => 1
        ])->assignRole('master');

        User::create([
            'name' => 'Mario',
            'email' => 'mario@tatour.com.br',
            'password' => 'Senha@Temporaria#',
            'status_id' => 1
        ])->assignRole('admin');

         User::create([
            'name' => 'Jairo',
            'email' => 'jairo@tatour.com.br',
            'password' => 'Senha@2023#',
            'status_id' => 1
        ])->assignRole('admin');

        User::create([
            'name' => 'Felipe Mendonça',
            'email' => 'feliipemendonca@outlook.com',
            'password' => 'Roott1234',
            'status_id' => 1
        ])->assignRole('master');

        User::create([
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'password' => '123123',
            'status_id' => 1
        ])->assignRole('admin');

    }
}
