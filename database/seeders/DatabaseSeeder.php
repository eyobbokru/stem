<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'coordinator']);
        // Role::create(['name' => 'museum']);
        // Role::create(['name' => 'coe']);

        // $permissions = Permission::all();
        // $role = Role::where('name','admin')->where('guard_name','web')->first();

        // $role->syncPermissions($permissions);

        
    }
}
