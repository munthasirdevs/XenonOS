<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@xenonos.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );

        $role = \DB::table('roles')->where('slug', 'super_admin')->first();
        if ($role && $user) {
            \DB::table('role_user')->updateOrInsert(
                ['user_id' => $user->id, 'role_id' => $role->id],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}