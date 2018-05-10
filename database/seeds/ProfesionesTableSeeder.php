<?php

use Illuminate\Database\Seeder;

class ProfesionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arreglo2 = [
            'Administración de Empresas',
            'Economía',
            'Industrial',
            'Contaduría',
            'Mercadeo',
            'Planeación Estratégica',
            'Estadística',
            'Costos',
            'Sistemas',
            'Administración Turística y Hotelera',
            'Administración de Aerolíneas',
            'Finanzas',
            'Recursos Humanos',
            'Contabilidad',
            'Nómina y Prestaciones Sociales',
            'Telecomunicaciones',
            'Informática',
            'Electricidad',
            'Mantenimiento',
            'Comercio Exterior',
            'Documental',
            'Archivística',
            'Técnico en despacho de aeronaves',
            'Electromecánica'
        ];


        $arreglo3 = [

            'Administración de Empresas',
            'Administración Aeronáutica',
            'Economía',
            'Ingeniería Industrial',
            'Administración Pública',
            'Contaduría Pública',
            'Derecho',
            'Mercadeo',
            'Psicología',
            'Comunicación Social',
            'Ingeniería en Higiene y Seguridad Ocupacional',
            'Ingeniería Ambiental',
            'Medicina',
            'Enfermería',
            'Bacteriología',
            'Ingeniería Aeronáutica',
            'Ingeniería Mecánica',
            'Ingeniería Eléctrica',
            'Ingeniería Electrónica',
            'Telecomunicaciones',
            'Informática',
            'Ingeniería Logística',
            'Administración Documental',
            'Ingeniería Archivística',
            'Ingeniería Bibliotecología',
            'Relaciones Económicas Internacionales',
            'Negocios Internacionales',
            'Piloto Instructor',
            'Piloto',
            'Copiloto',
            'Ingeniería Mecánica',
            'Metalúrgica',
            'Electromecánica'
        ];

        $arreglo4 = [

            'Mantenimiento Aeronáutico',
            'Derecho Comercial',
            'Derecho Aéreo',
            'Derecho Civil',
            'Derecho Administrativo',
            'Derecho Laboral',
            'Derecho Aduanero',
            'Derecho Procesal',
            'Administración',
            'Finanzas',
            'Gerencia y Presupuesto',
            'Evaluación de Proyectos',
            'Gestión del Talento Humano',
            'Salud Ocupacional',
            'Aeronáutica'
        ];

        $arreglo5 = [

            'Mantenimiento Aeronáutico',
            'Derecho Comercial',
            'Derecho Aéreo',
            'Derecho Civil',
            'Derecho Administrativo',
            'Derecho Laboral',
            'Derecho Aduanero',
            'Derecho Procesal',
            'Administración',
            'Finanzas',
            'Gerencia y Presupuesto',
            'Evaluación de Proyectos',
            'Gestión del Talento Humano',
            'Salud Ocupacional',
            'Aeronáutica'
        ];



        // BACHILLER
        DB::table('profesiones')->insert([
            [
                'titulo'               => 'bachiller',
                'nivel_academico'      => 'bachiller'
            ],
        ]);

        // TSU
        for ($i=0 ; $i < count($arreglo2); $i++)
        {

            DB::table('profesiones')->insert([
                [
                    'titulo'               => $arreglo2[$i],
                    'nivel_academico'      => 'tsu'
                ],

            ]);
        }

        // PROFESIONAL
        for ($i=0 ; $i < count($arreglo3); $i++)
        {

            DB::table('profesiones')->insert([
                [
                    'titulo'               => $arreglo3[$i],
                    'nivel_academico'      => 'profesional'
                ],

            ]);
        }

        // especialista1
        for ($i=0 ; $i < count($arreglo4); $i++)
        {

            DB::table('profesiones')->insert([
                [
                    'titulo'               => $arreglo4[$i],
                    'nivel_academico'      => 'especialista 1'
                ],

            ]);
        }


        // especialista2
        for ($i=0 ; $i < count($arreglo5); $i++)
        {

            DB::table('profesiones')->insert([
                [
                    'titulo'               => $arreglo5[$i],
                    'nivel_academico'      => 'especialista 2'
                ],

            ]);
        }


    }
}
