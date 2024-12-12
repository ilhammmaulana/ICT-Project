<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();

        $role_user = Role::where('name', 'user')->first();
        $users = User::where('email', '!=', 'admin@unsia.ac.id')->get();

        foreach ($users as $user) {
            $user->assignRole($role_user);
        }

        User::create([
            'id' => Str::uuid(),
            'name' => 'Admin',
            'email' => 'admin@unsia.ac.id',
            'password' => Hash::make('password'),
        ])->assignRole('admin');
        User::create([
            'id' => Str::uuid(),
            'name' => 'User',
            'email' => 'user@unsia.ac.id',
            'password' => Hash::make('password'),
        ])->assignRole('user');
    }
}
