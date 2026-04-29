<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Roles
        $adminRole = Role::create(['name' => 'Administrator', 'slug' => 'admin']);
        $teknisiRole = Role::create(['name' => 'Teknisi', 'slug' => 'teknisi']);

        // 2. Create Permissions
        $modules = [
            'berita_acara' => 'Berita Acara',
            'maintenance' => 'Maintenance',
            'vendor' => 'Vendor',
            'backbone' => 'Backbone',
        ];

        $actions = [
            'view' => 'Melihat',
            'create' => 'Menambah',
            'edit' => 'Mengubah',
            'delete' => 'Menghapus',
        ];

        foreach ($modules as $mSlug => $mName) {
            foreach ($actions as $aSlug => $aName) {
                Permission::create([
                    'name' => "$aName $mName",
                    'slug' => "{$mSlug}_{$aSlug}",
                    'group' => $mName
                ]);
            }
        }

        // Extra permissions
        Permission::create(['name' => 'Mengelola User', 'slug' => 'users_manage', 'group' => 'System']);
        Permission::create(['name' => 'Mengelola Role & Akses', 'slug' => 'roles_manage', 'group' => 'System']);

        // 3. Assign Permissions to Teknisi (Only view, create, edit)
        $teknisiPermissions = Permission::whereIn('slug', [
            'berita_acara_view', 'berita_acara_create', 'berita_acara_edit',
            'maintenance_view', 'maintenance_create', 'maintenance_edit',
            'vendor_view', 'vendor_create', 'vendor_edit',
            'backbone_view', 'backbone_create', 'backbone_edit',
        ])->get();
        
        $teknisiRole->permissions()->attach($teknisiPermissions);

        // 4. Create Users
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'no_hp' => '081234567890',
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Teknisi Utama',
            'username' => 'teknisi',
            'password' => Hash::make('password'),
            'no_hp' => '081234567891',
            'role_id' => $teknisiRole->id,
        ]);

        $this->call([
            VendorSeeder::class,
            BackboneSeeder::class,
            BeritaAcaraSeeder::class,
            MaintenanceSeeder::class,
        ]);
    }
}
