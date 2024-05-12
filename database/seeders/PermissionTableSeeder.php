<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [ 
            'dashboard',
            'master-data',
            'departement-list',
            'departement-create',
            'departement-edit',
            'departement-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'history-log-list',
            'history-log-delete',
            'profile',
            'profile-edit',
            'menu-admin',
            'approval-user',
            'approval-alat',
            'my-alat',
            'menu-user',
            'menu-pinjaman',
            'request-pinjaman-my-alat',
            'peminjaman',
            'menu-pengembalian',
            'request-pengembalian-my-alat',
            'pengembalian',
            'menu-umum',
            'alat',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
