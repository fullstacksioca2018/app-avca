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
            'modulo'            => 'rrhh',
            'email'             => 'admin@avca.com',
            'password'          => bcrypt('admin'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name'              => 'Pepito Pérez',
            'modulo'            => 'rrhh',
            'email'             => 'pperez@gmail.com',
            'password'          => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name'              => 'Jaimito Jopez',
            'modulo'            => 'reporte',
            'email'             => 'gerentegeneral@gmail.com',
            'password'          => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Pablito Garcia',
            'modulo'            => 'operativo2',
            'email' => 'sucursales@gmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Juan Garcia',
            'modulo'            => 'operativo2',
            'email' => 'subgerente@gmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Jarel Machado',
            'modulo'            => 'operativo1',
            'email' => 'taquilla@gmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Dolores De Cabeza',
            'modulo'            => 'rrhh',
            'email' => 'dolores.cabeza@avca.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
        


        //de aqui RRHH usuario 8
        DB::table('users')->insert([
            'name' => 'Gerente',
            'modulo'            => 'rrhh',
            'email' => 'GerenteRRHH@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Renzo Jose',
            'modulo'            => 'rrhh',
            'email' => 'Analista-Administrativo@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'Cesar',
            'modulo'            => 'rrhh',
            'email' => 'Analista-Operativo@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'Victor',
            'modulo'            => 'rrhh',
            'email' => 'Analista-telematico@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
         DB::table('users')->insert([
            'name' => 'Carolina',
            'modulo'            => 'rrhh',
            'email' => 'Analista-Apoyo-Logistico@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
         DB::table('users')->insert([
            'name' => 'Isabel',
            'modulo'            => 'rrhh',
            'email' => 'Analista-oficina@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
         DB::table('users')->insert([
            'name' => 'Luis',
            'modulo'            => 'rrhh',
            'email' => 'Analista-Tripulacion@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
         DB::table('users')->insert([
            'name' => 'Gerente',
            'modulo'            => 'rrhh',
            'email' => 'Gerente-Sucursal@hotmail.com',
            'password' => bcrypt('gerente'),
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
         DB::table('users')->insert([
            'name' => 'Analista',
            'modulo'            => 'rrhh',
            'email' => 'Analista-Nomina@hotmail.com',
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
            'slug'      => 'gerente',
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

            //roles RRHH
        Role::create([
            'name'      => 'Gerente de sucursal',
            'slug'      => 'gerente.sucursal',
            'special'   => 'all-access'
        ]);
        Role::create([
            'name'      => 'Analista Nomina',
            'slug'      => 'analista.nomina',
            'special'   => 'all-access'
        ]);
         Role::create([
            'name'      => 'Analista Personal',
            'slug'      => 'analista.area',
            'special'   => 'all-access'
        ]);
          Role::create([
            'name'      => 'Empleado',
            'slug'      => 'empleado',
            'special'   => 'all-access'
        ]);



            DB::table('role_user')->insert([
                'user_id' => 1,
                'role_id' => 1 
            ]);
         /*   DB::table('role_user')->insert([
                'user_id' => 1, 
                'role_id' => 2 
            ]);*/
            DB::table('role_user')->insert([
                'user_id' => 2,
                'role_id' => 2 
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


            //roles_user RRHH
        
        DB::table('role_user')->insert([
                'user_id' => 7,
                'role_id' => 7 
            ]);
        DB::table('role_user')->insert([
                'user_id' => 9,
                'role_id' => 9
            ]);
        DB::table('role_user')->insert([
                'user_id' => 16,
                'role_id' => 8 
            ]);
        DB::table('role_user')->insert([
                'user_id' => 13,
                'role_id' => 10
            ]);

    }
}
