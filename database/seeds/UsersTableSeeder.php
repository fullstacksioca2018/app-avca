<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Pepito Pérez',
            'email' => 'pperez@gmail.com',
            'password' => bcrypt('gerente'),
            'role' => 'Gerente RRHH'
        ]);

        DB::table('users')->insert([
            'name' => 'Jaimito Lopez',
            'email' => 'gerentegeneral@gmail.com',
            'password' => bcrypt('gerente'),
            'role' => 'Gerente General'
        ]);
    }
}
