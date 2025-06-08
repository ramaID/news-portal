<?php

namespace Tests;

use App\Models\User;
use Laravolt\Platform\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getAdminUser(): User
    {
        // Buat pengguna admin
        Artisan::call('laravolt:admin Administrator admin@laravolt.dev secret');

        Artisan::call('laravolt:sync-permission');

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermission(
            ['*'] + \Laravolt\Platform\Models\Permission::all()->pluck('name')->toArray()
        );

        $admin = User::query()->where('email', 'admin@laravolt.dev')->first();
        $admin->assignRole('admin');

        return $admin;
    }
}
