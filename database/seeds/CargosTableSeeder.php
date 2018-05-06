<?php

use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargos')->insert([
            [
                'titulo'                => 'director operaciones aéreas',
                'perfil'                => '',
                'tabulador_salarial_id' => 24,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],            
            [
                'titulo'                => 'secretaria ejecutiva',
                'perfil'                => '',
                'tabulador_salarial_id' => 2,
                'area_id'               => 4,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'coordinador rampa y despacho',
                'perfil'                => '',
                'tabulador_salarial_id' => 2,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'gestor de calidad',
                'perfil'                => '',
                'tabulador_salarial_id' => 15,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'gestor de aeronáutica civil',
                'perfil'                => '',
                'tabulador_salarial_id' => 15,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'analista operacional de flota',
                'perfil'                => '',
                'tabulador_salarial_id' => 15,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'estandarizador equipos operados por avca',
                'perfil'                => '',
                'tabulador_salarial_id' => 16,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'piloto ',
                'perfil'                => '',
                'tabulador_salarial_id' => 19,
                'area_id'               => 6,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Copiloto ',
                'perfil'                => '',
                'tabulador_salarial_id' => 18,
                'area_id'               => 6,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'auxiliar de servicio abordo',
                'perfil'                => '',
                'tabulador_salarial_id' => 13,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'despachador de aviones',
                'perfil'                => '',
                'tabulador_salarial_id' => 11,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'despachador instructor',
                'perfil'                => '',
                'tabulador_salarial_id' => 12,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'auxiliar de despacho',
                'perfil'                => '',
                'tabulador_salarial_id' => 1,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'estadistica centro control de operaciones',
                'perfil'                => '',
                'tabulador_salarial_id' => 1,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'auxiliar equipo terrestre de apoyo aeronautico',
                'perfil'                => '',
                'tabulador_salarial_id' => 1,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'operador de radio',
                'perfil'                => '',
                'tabulador_salarial_id' => 5,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'tecnico gestion entrenamiento pilotos',
                'perfil'                => '',
                'tabulador_salarial_id' => 3,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            //nuevos creados,
            [
                'titulo'                => 'jefe de sistemas',
                'perfil'                => '',
                'tabulador_salarial_id' => 24,
                'area_id'               => 5,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'coordinador de proyectos de sistemas',
                'perfil'                => '',
                'tabulador_salarial_id' => 23,
                'area_id'               => 5,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'tecnico de software de operaciones',
                'perfil'                => '',
                'tabulador_salarial_id' => 2,
                'area_id'               => 5,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'tecnico de apoyo logistico',
                'perfil'                => '',
                'tabulador_salarial_id' => 4,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'tecnico de mantenimiento de instalaciones',
                'perfil'                => '',
                'tabulador_salarial_id' => 2,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'auxiliar de mantenimiento de instalaciones',
                'perfil'                => '',
                'tabulador_salarial_id' => 1,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'conductor',
                'perfil'                => '',
                'tabulador_salarial_id' => 3,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'coordinador de contratos interadministrativos',
                'perfil'                => '',
                'tabulador_salarial_id' => 22,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'analista de ventas presenciales y no presenciales',
                'perfil'                => '',
                'tabulador_salarial_id' => 1,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'jefe presupuesto',
                'perfil'                => '',
                'tabulador_salarial_id' => 24,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'jefe de creditos y recaudos',
                'perfil'                => '',
                'tabulador_salarial_id' => 24,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'analista y auxiliar de contabilidad',
                'perfil'                => '',
                'tabulador_salarial_id' => 17,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'tecnico apoyo en asuntos legales',
                'perfil'                => '',
                'tabulador_salarial_id' => 4,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],

        ]);
    }
}
