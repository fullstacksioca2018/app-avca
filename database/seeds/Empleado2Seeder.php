<?php

use Illuminate\Database\Seeder;
use App\Models\operativo\Empleado2;

class Empleado2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\operativo\Empleado2::class, 10)->create()
        ->each(function($u){
            $u->tripulante()->save(factory(App\Models\operativo\Tripulante::class)->make([
                'rango' => 'piloto'               
                ])
            );
        });
        factory(\App\Models\operativo\Empleado2::class, 10)->create()
        ->each(function($u){
            $u->tripulante()->save(factory(App\Models\operativo\Tripulante::class)->make([
                'rango' => 'copiloto'               
                ])
            );
        });
        factory(\App\Models\operativo\Empleado2::class, 10)->create()
        ->each(function($u){
            $u->tripulante()->save(factory(App\Models\operativo\Tripulante::class)->make([
                'rango' => 'jefe de cabina'               
                ])
            );
        });
        factory(\App\Models\operativo\Empleado2::class, 10)->create()
        ->each(function($u){
            $u->tripulante()->save(factory(App\Models\operativo\Tripulante::class)->make([
                'rango' => 'sobrecargo'               
                ])
            );
        });
     
        
    }
     
          
    }

