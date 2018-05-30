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

        DB::table('users')->insert([
            'name'              => 'Jaimito Jopez',
            'email'             => 'gerentegeneral@gmail.com',
            'password'          => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Pablito Garcia',
            'email' => 'sucursales@gmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Juan Garcia',
            'email' => 'subgerente@gmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Jarel Machado',
            'email' => 'taquilla@gmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
        
        Role::create([
            'name'      => 'Admin',
            'slug'      => 'admin',
            'special'   => 'all-access'
        ]);

        Role::create([
            'name'      => 'Gerente RRHH',
            'slug'      => 'gerente.RRHH',
            'special'   => 'all-access'
        ]);

        Role::create([
            'name'      => 'Gerente General',
            'slug'      => 'gerente.general',
            'special'   => 'all-access'
        ]);

        Role::create([
            'name'      => 'Gerente de Sucursales',
            'slug'      => 'gerente.sucursales',
            'special'   => 'all-access'
        ]);

        Role::create([
            'name'      => 'Subgerente de Sucursal',
            'slug'      => 'subgerente.sucursal',
            'special'   => 'all-access'
        ]);

        Role::create([
            'name'      => 'Operador De Taquilla',
            'slug'      => 'operador.taquilla',
            'special'   => 'all-access'
        ]);
        Role::create([
            'name'      => 'Gerente RRHH',
            'slug'      => 'gerente',
            'special'   => 'all-access'
        ]);

            DB::table('role_user')->insert([
                'user_id' => 1,
                'role_id' => 1 
            ]);
            DB::table('role_user')->insert([
                'user_id' => 1, 
                'role_id' => 2 
            ]);
            DB::table('role_user')->insert([
                'user_id' => 2,
                'role_id' => 2 
            ]);
            DB::table('role_user')->insert([
                'user_id' => 2,
                'role_id' => 7 
            ]);
            DB::table('role_user')->insert([
                'user_id' => 3,
                'role_id' => 3 
            ]);
            DB::table('role_user')->insert([
                'user_id' => 4,
                'role_id' => 4 
            ]);
            DB::table('role_user')->insert([
                'user_id' => 5,
                'role_id' => 5 
            ]);
            DB::table('role_user')->insert([
                'user_id' => 6,
                'role_id' => 6 
            ]);
    }
}
