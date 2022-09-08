<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        $json = file_get_contents(storage_path('permission.json'));

        $objs = json_decode($json,true);

        foreach ($objs as $obj) {
            foreach ($obj as $key => $value) {
                $insertArr[$key] = $value;
            }
            Permission::create($insertArr);
        }

        $luckyPermissions = [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_lucky',
            'add_lucky',
            'edit_lucky',
            'delete_lucky',
        ];

        $pathanPermissions = [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_pathans',
            'add_pathans',
            'edit_pathans',
            'delete_pathans',
        ];

        Role::create(['name'=>'superuser','guard_name' =>'web'])->givePermissionTo(Permission::all());
        Role::create(['name'=>'admin','guard_name'=>'web'])->givePermissionTo(Permission::all());

        Role::create(['name'=>'lucky','guard_name'=>'web'])->givePermissionTo($luckyPermissions);
        Role::create(['name'=>'pathan','guard_name'=>'web'])->givePermissionTo($pathanPermissions);

        $superadmin = User::create([
           'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'password' => '12345678'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => '12345678'
        ]);

        $lucky = User::create([
            'name' => 'Lucky',
            'email' => 'lucky@gmail.com',
            'username' => 'lucky',
            'password' => '12345678'
        ]);

        $pathan = User::create([
            'name' => 'Pathan',
            'email' => 'pathan@gmail.com',
            'username' => 'pathan',
            'password' => '12345678'
        ]);

        $superadmin->assignRole('superuser');
        $admin->assignRole('admin');
        $lucky->assignRole('lucky');
        $pathan->assignRole('pathan');

    }

}
