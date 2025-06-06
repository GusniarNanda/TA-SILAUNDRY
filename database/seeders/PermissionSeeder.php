<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::updateOrCreate(
            [
                'name' => 'admin',
            ],
            ['name' => 'admin']
        );

        $role_user = Role::updateOrCreate(
            [
                'name' => 'user',
            ],
            ['name' => 'user']
        );

        $role_owner = Role::updateOrCreate(
            [
                'name' => 'owner',
            ],
            ['name' => 'owner']
        );
        $permission = Permission::updateOrCreate(
            [
                'name' => 'tambah_admin',
            ],
            ['name' => 'tambah_admin']
        );

        $permission2 = Permission::updateOrCreate(
            [
                'name' => 'view_pemasukan_on_dashboard',
            ],
            ['name' => 'view_pemasukan_on_dashboard']
        );

        $permission3 = Permission::updateOrCreate(
            [
                'name' => 'view_pesanan',
            ],
            ['name' => 'view_pesanan']
        );
        $role_admin->givePermissionTo($permission);
        $role_admin->givePermissionTo($permission2);
        $role_owner->givePermissionTo($permission2);
        $role_user->givePermissionTo($permission3);

        $user = User::find(1);
        if($user){
            $user->assignRole(['admin','owner']);
        }
    }
}
    