<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    public $roles = ['admin', 'user', 'editor'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $key => $role) {
            $role = Role::create([
                "name" => $role
            ]);
        }
    }
}
