<?php

namespace Database\Seeders;

use App\Enums\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Laravolt\Platform\Models\Role;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat peran
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $writer = Role::firstOrCreate(['name' => 'Writer']);
        $member = Role::firstOrCreate(['name' => 'Member']);

        // Pastikan izin disinkronkan
        Artisan::call('laravolt:sync-permission');

        // Berikan semua izin kepada admin (wildcard)
        $admin->syncPermission(['*']);

        // Berikan izin tertentu kepada peran Penulis
        $writer->syncPermission([
            Permission::DASHBOARD_VIEW,
            Permission::POST_VIEW,
            Permission::POST_CREATE,
            Permission::POST_EDIT,
            Permission::POST_DELETE,
            Permission::COMMENT_VIEW,
            Permission::COMMENT_CREATE,
            Permission::COMMENT_EDIT,
            Permission::COMMENT_DELETE,
        ]);

        // Berikan izin tertentu kepada peran Anggota
        $member->syncPermission([
            Permission::COMMENT_VIEW,
            Permission::COMMENT_CREATE,
            Permission::COMMENT_EDIT,
            Permission::COMMENT_DELETE,
        ]);
    }
}
