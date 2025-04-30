<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat pengguna admin
        Artisan::call('laravolt:admin Administrator admin@laravolt.dev secret');

        /** @var User */
        $admin = User::query()->where('email', 'admin@laravolt.dev')->first();
        $admin->assignRole('admin');

        // Buat pengguna penulis
        $writer = User::firstOrCreate(
            ['email' => 'writer@laravolt.dev'],
            [
                'name' => 'Content Writer',
                'password' => Hash::make('secret'),
                'status' => 'ACTIVE',
            ]
        );
        $writer->assignRole('Writer');

        // Buat pengguna anggota
        $member = User::firstOrCreate(
            ['email' => 'member@laravolt.dev'],
            [
                'name' => 'Regular Member',
                'password' => Hash::make('password'),
                'status' => 'ACTIVE',
            ]
        );
        $member->assignRole('Member');
    }
}
