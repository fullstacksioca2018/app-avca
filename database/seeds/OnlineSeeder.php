<?php

use Illuminate\Database\Seeder;

class OnlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('onlines')->insert([
            'name'  => 'sinasignar',
            'email' => 'sinasignar@nada.com',
            'password' => '0000'
        ]);
    }
}
