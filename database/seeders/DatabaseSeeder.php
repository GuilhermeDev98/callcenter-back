<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Models\Role::create(["name" => "TI"]);
        \App\Models\User::create([
            "name" => "Guilherme Santos",
            "email" => "guilhermedev@hotmail.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
            "role_id" => 1
        ]);

        \App\Models\Permission::create(["name" => "dashboard.show"]);
        \App\Models\Permission::create(["name" => "attendance.show"]);
        \App\Models\Permission::create(["name" => "role.show"]);
        \App\Models\Permission::create(["name" => "permission"]);
        \App\Models\Permission::create(["name" => "client.show"]);
        \App\Models\Permission::create(["name" => "employee.show"]);

        $role->permissions()->attach(['1', '2', '3', '4', '5', '6']);
        $role->save();
    }
}
