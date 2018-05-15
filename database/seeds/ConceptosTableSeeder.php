<?php

use Illuminate\Database\Seeder;

class ConceptosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            //
            DB::table('conceptos')->insert([

                [
                    'tipo_concepto' 	=> '101',
                    'descripcion'   	=> 'Sueldo básico',
                    'porcentaje'  		=> null,
                    'valor_fijo' 		=> null,
                    'valor_variable' 	=> null,
                    'bono_vacacional'	=> '1',
                    'utilidades'		=> '1',
                    'prestaciones' 		=> '1',
                    'isl' 				=> '1'
                ],

                [
                    'tipo_concepto'     => '103',
                    'descripcion'       => 'Prima por antigüedad',
                    'porcentaje'        => 2,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '1'
                ],
                [
                    'tipo_concepto'     => '105',
                    'descripcion'       => 'Prima pr hijos',
                    'porcentaje'        => null,
                    'valor_fijo'        => 200000,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '107',
                    'descripcion'       => 'Bono por asistencia perfecta',
                    'porcentaje'        => null,
                    'valor_fijo'        => 200000,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '0',
                    'utilidades'        => '0',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '109',
                    'descripcion'       => 'Bono de riesgo',
                    'porcentaje'        => 15,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '111',
                    'descripcion'       => 'Hora de vuelo de Piloto',
                    'porcentaje'        => null,
                    'valor_fijo'        => 100000,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '113',
                    'descripcion'       => 'Hora de vuelo de 1er Oficial - Copiloto',
                    'porcentaje'        => null,
                    'valor_fijo'        => 70000,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '115',
                    'descripcion'       => 'Hora de vuelo de Sobrecargo',
                    'porcentaje'        => null,
                    'valor_fijo'        => 40000,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '117',
                    'descripcion'       => 'Prima por hogar',
                    'porcentaje'        => null,
                    'valor_fijo'        => 400000,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '1'
                ],
                [
                    'tipo_concepto'     => '119',
                    'descripcion'       => 'Prima de profesionalización TSU',
                    'porcentaje'        => 10,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '1'
                ],
                [
                    'tipo_concepto'     => '121',
                    'descripcion'       => 'Prima de profesionalización Grado',
                    'porcentaje'        => 14,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '1'
                ],
                [
                    'tipo_concepto'     => '123',
                    'descripcion'       => 'Prima de profesionalización Magister',
                    'porcentaje'        => 18,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '1'
                ],
                [
                    'tipo_concepto'     => '125',
                    'descripcion'       => 'Prima de profesionalización Doctorado',
                    'porcentaje'        => 22,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '1'
                ],
                [
                    'tipo_concepto'     => '127',
                    'descripcion'       => 'Bono de productividad',
                    'porcentaje'        => null,
                    'valor_fijo'        => 200000,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '0',
                    'utilidades'        => '0',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '129',
                    'descripcion'       => 'Media hora de reposo y comida',
                    'porcentaje'        => 5,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '502',
                    'descripcion'       => 'Aporte Seguro Social Obligatorio',
                    'porcentaje'        => 4,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '0',
                    'utilidades'        => '0',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '504',
                    'descripcion'       => 'Aporte del seguro de paro forzoso',
                    'porcentaje'        => 2,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '0',
                    'utilidades'        => '0',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '506',
                    'descripcion'       => 'Aporte FAOV',
                    'porcentaje'        => 2,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '0',
                    'utilidades'        => '0',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '508',
                    'descripcion'       => 'Embargo judicial',
                    'porcentaje'        => 10,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '1',
                    'utilidades'        => '1',
                    'prestaciones'      => '1',
                    'isl'               => '1'
                ],
                [
                    'tipo_concepto'     => '510',
                    'descripcion'       => 'Descuento de día de ausencia',
                    'porcentaje'        => null,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '0',
                    'utilidades'        => '0',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
                [
                    'tipo_concepto'     => '512',
                    'descripcion'       => 'Descuento por hora de ausencia',
                    'porcentaje'        => null,
                    'valor_fijo'        => null,
                    'valor_variable'    => null,
                    'bono_vacacional'   => '0',
                    'utilidades'        => '0',
                    'prestaciones'      => '0',
                    'isl'               => '0'
                ],
            ]);
        }
    }
}
