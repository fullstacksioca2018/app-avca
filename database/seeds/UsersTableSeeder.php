<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'Admin',
            'email'             => 'admin@avca.com',
            'password'          => bcrypt('admin'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name'              => 'Pepito Pérez',
            'email'             => 'pperez@gmail.com',
            'password'          => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        Role::create([
            'name'      => 'Admin',
            'slug'      => 'admin',
            'special'   => 'all-access'
        ]);
    }
}
