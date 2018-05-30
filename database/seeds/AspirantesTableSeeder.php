<?php

use Illuminate\Database\Seeder;

class AspirantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('aspirantes')->truncate();

        DB::table('aspirantes')->insert([        
            'cedula' => 22921640,
            'nacionalidad' => 'v',
            'fecha_nacimiento' => '1993-07-28',
            'sexo' => 'f',
            'apellido' => 'Bruzual',
            'nombre' => 'Martha',
            'email' => 'milimar_0@hotmail.com',
            'telefono_movil' => '04264857382',
            'telefono_fijo' => '02934673294',
            'curriculum' => 'curriculum',
            'vacante_id' => 1,
            'cargo_id' => 25,
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s')
        ]);
        DB::table('aspirantes')->insert([
                'cedula' => 16313659,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1982-05-14',
                'sexo' => 'm',
                'apellido' => 'Fabbiani',
                'nombre' => 'Jose',
                'email' => 'jovifabbiani@hotmail.com',
                'telefono_movil' => '04248333841',
                'telefono_fijo' => '02935144880',
                'curriculum' => 'curriculum',
                'vacante_id' => 1,
                'cargo_id' => 25,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
        ]);
            DB::table('aspirantes')->insert([
                'cedula' => 3871882,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1952-01-22',
                'sexo' => 'm',
                'apellido' => 'Faviani',
                'nombre' => 'Vicente',
                'email' => 'comiquitofaviani@gmail.com',
                'telefono_movil' => '04148406031',
                'telefono_fijo' => '02935144880',
                'curriculum' => 'curriculum',
                'vacante_id' => 1,
                'cargo_id' => 25,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 4188779,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1954-11-30',
                'sexo' => 'f',
                'apellido' => 'Marcano',
                'nombre' => 'Ana',
                'email' => 'anafaviani@gmail.com',
                'telefono_movil' => '04149944141',
                'telefono_fijo' => '02935144880',
                'curriculum' => 'curriculum',
                'vacante_id' => 1,
                'cargo_id' => 25,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
            DB::table('aspirantes')->insert([
                'cedula' => 163313688,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1983-11-07',
                'sexo' => 'f',
                'apellido' => 'Fabbiani',
                'nombre' => 'Vanessa',
                'email' => 'vanessafabbiani@gmail.com',
                'telefono_movil' => '04149944167',
                'telefono_fijo' => '02935144880',
                'curriculum' => 'curriculum',
                'vacante_id' => 2,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 28690222,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-10-01',
                'sexo' => 'f',
                'apellido' => 'González',
                'nombre' => 'Zuleidys',
                'email' => 'zuleidys01@gmail.com',
                'telefono_movil' => '04143931919',
                'telefono_fijo' => '02945142358',
                'curriculum' => 'curriculum',
                'vacante_id' => 2,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 29721806,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1979-11-22',
                'sexo' => 'f',
                'apellido' => 'Bermúdez  ',
                'nombre' => 'Michelle',
                'email' => 'michelle852@gmail.com',
                'telefono_movil' => '04243697238',
                'telefono_fijo' => '04167834720',
                'curriculum' => 'curriculum',
                'vacante_id' => 2,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30078848,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1989-03-17',
                'sexo' => 'm',
                'apellido' => 'Rojas',
                'nombre' => 'Jesús',
                'email' => 'jesus8@gmail.com',
                'telefono_movil' => '04168542387',
                'telefono_fijo' => '02956123597',
                'curriculum' => 'curriculum',
                'vacante_id' => 2,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
            DB::table('aspirantes')->insert([
                'cedula' => 28765538,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1997-12-01',
                'sexo' => 'f',
                'apellido' => 'Yendiz',
                'nombre' => 'Carmen',
                'email' => 'armen299@gmail.com',
                'telefono_movil' => '04249635974',
                'telefono_fijo' => '02934312225',
                'curriculum' => 'curriculum',
                'vacante_id' => 3,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
        DB::table('aspirantes')->insert([
                'cedula' => 30143089,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-10-01',
                'sexo' => 'm',
                'apellido' => 'Salazar',
                'nombre' => 'Jesús',
                'email' => 'jesuss22@gmail.com',
                'telefono_movil' => '04242687593',
                'telefono_fijo' => '02813154785',
                'curriculum' => 'curriculum',
                'vacante_id' => 3,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30379484,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-10-01',
                'sexo' => 'f',
                'apellido' => 'Suniaga',
                'nombre' => 'Fabiana',
                'email' => 'fabianasuni14@gmail.com',
                'telefono_movil' => '04248534582',
                'telefono_fijo' => '02934678523',
                'curriculum' => 'curriculum',
                'vacante_id' => 3,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30508924,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1968-05-10',
                'sexo' => 'm',
                'apellido' => 'Alemán',
                'nombre' => 'Kilver',
                'email' => 'kilver5ale@gmail.com',
                'telefono_movil' => '04267894136',
                'telefono_fijo' => '02945161287',
                'curriculum' => 'curriculum',
                'vacante_id' => 3,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
DB::table('aspirantes')->insert([
                'cedula' => 30804497,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1985-06-28',
                'sexo' => 'm',
                'apellido' => 'Espinoza',
                'nombre' => 'Moisés',
                'email' => 'espinozajiménezmoisés@gmail.com',
                'telefono_movil' => '04126982271',
                'telefono_fijo' => '02126589243',
                'curriculum' => 'curriculum',
                'vacante_id' => 4,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
DB::table('aspirantes')->insert([
                'cedula' => 31279311,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1998-11-15',
                'sexo' => 'f',
                'apellido' => 'Lemus',
                'nombre' => 'Sairini',
                'email' => 'lemusfloressairini@gmail.com',
                'telefono_movil' => '04264568217',
                'telefono_fijo' => '02946547896',
                'curriculum' => 'curriculum',
                'vacante_id' => 4,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 31043150,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1986-08-21',
                'sexo' => 'f',
                'apellido' => 'Guerra',
                'nombre' => 'Ghandy',
                'email' => 'guerrabermúdezghandy55295@gmail.com',
                'telefono_movil' => '04249638574',
                'telefono_fijo' => '02951234585',
                'curriculum' => 'curriculum',
                'vacante_id' => 4,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30379339,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1995-07-12',
                'sexo' => 'm',
                'apellido' => 'Tarrazzi Rodríguez',
                'nombre' => 'Carlos',
                'email' => 'carlos652tarrazzi95@gmail.com',
                'telefono_movil' => '04268236211',
                'telefono_fijo' => '02813692142',
                'curriculum' => 'curriculum',
                'vacante_id' => 4,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
DB::table('aspirantes')->insert([
                'cedula' => 30635736,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1969-02-07',
                'sexo' => 'm',
                'apellido' => 'González Morey',
                'nombre' => 'Williams',
                'email' => 'williams295@gmail.com',
                'telefono_movil' => '04241598631',
                'telefono_fijo' => '02833578213',
                'curriculum' => 'curriculum',
                'vacante_id' => 5,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s')
            ]);
DB::table('aspirantes')->insert([
                'cedula' => 30989089,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1959-04-27',
                'sexo' => 'm',
                'apellido' => 'Vásquez Ramírez',
                'nombre' => 'Carlos',
                'email' => '95295carlos@gmail.com',
                'telefono_movil' => '04129521366',
                'telefono_fijo' => '02641479655',
                'curriculum' => 'curriculum',
                'vacante_id' => 5,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30143077,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1978-01-26',
                'sexo' => 'f',
                'apellido' => 'García Guanches',
                'nombre' => 'Adanelys',
                'email' => 'garciaguaraches99@gmail.com',
                'telefono_movil' => '04128523687',
                'telefono_fijo' => '02126984523',
                'curriculum' => 'curriculum',
                'vacante_id' => 5,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30336048,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1987-10-01',
                'sexo' => 'm',
                'apellido' => 'Marín Bruzual',
                'nombre' => 'Samuel',
                'email' => 'samuelmb87@gmail.com',
                'telefono_movil' => '04262289346',
                'telefono_fijo' => '02692296375',
                'curriculum' => 'curriculum',
                'vacante_id' => 5,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
DB::table('aspirantes')->insert([
                'cedula' => 28722182,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1981-09-18',
                'sexo' => 'm',
                'apellido' => 'Parra Cabello',
                'nombre' => 'Albert',
                'email' => 'albertpc81@gmail.com',
                'telefono_movil' => '04248523674',
                'telefono_fijo' => '02322558899',
                'curriculum' => 'curriculum',
                'vacante_id' => 6,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s')
            ]);
            
DB::table('aspirantes')->insert([
                'cedula' => 29906485,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1994-07-12',
                'sexo' => 'f',
                'apellido' => 'Cordero Arreaza',
                'nombre' => 'Cirianny',
                'email' => 'ciriannyac94@gmail.com',
                'telefono_movil' => '04129871433',
                'telefono_fijo' => '02242263176',
                'curriculum' => 'curriculum',
                'vacante_id' => 6,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30378815,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1987-01-30',
                'sexo' => 'm',
                'apellido' => 'Bruzual Lezama',
                'nombre' => 'Moisés',
                'email' => 'moisesbl87@gmail.com',
                'telefono_movil' => '04129524699',
                'telefono_fijo' => '02483336685',
                'curriculum' => 'curriculum',
                'vacante_id' => 6,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
                ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30636549,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1997-08-21',
                'sexo' => 'm',
                'apellido' => 'Esparragoza Mayz',
                'nombre' => 'Cesar',
                'email' => 'emayzcesar97@gmail.com',
                'telefono_movil' => '04245324971',
                'telefono_fijo' => '02934678532',
                'curriculum' => 'curriculum',
                'vacante_id' => 6,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            // vacantes renzo
            // vacantes 7
            DB::table('aspirantes')->insert([
                'cedula' => 30078548,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1985-12-26',
                'sexo' => 'f',
                'apellido' => 'Carvajal García',
                'nombre' => 'Fadrianyela',
                'email' => 'Fadrianyela1985@hotmail.com',
                'telefono_movil' => '04268410300',
                'telefono_fijo' => '02934214507',
                'curriculum' => 'curriculum',
                'vacante_id' => 7,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30917640,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-11-11',
                'sexo' => 'm',
                'apellido' => 'Pabón Lezama',
                'nombre' => 'Ángel',
                'email' => 'angelpl2@hotmail.com',
                'telefono_movil' => '04248301400',
                'telefono_fijo' => '02632687410',
                'curriculum' => 'curriculum',
                'vacante_id' => 7,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 31043508,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-10-01',
                'sexo' => 'm',
                'apellido' => 'Ramírez Suárez',
                'nombre' => 'Jhoanny',
                'email' => 'r3sjhoanny@hotmail.com',
                'telefono_movil' => '04262103640',
                'telefono_fijo' => '02362038542',
                'curriculum' => 'curriculum',
                'vacante_id' => 7,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30804574,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1991-09-07',
                'sexo' => 'm',
                'apellido' => 'Carvajal Meaño',
                'nombre' => 'Juancamilo',
                'email' => 'cm4juancamilo@hotmail.com',
                'telefono_movil' => '04241597563',
                'telefono_fijo' => '02983459971',
                'curriculum' => 'curriculum',
                'vacante_id' => 7,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            // vacantes 8
            DB::table('aspirantes')->insert([
                'cedula' => 30989321,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1996-07-18',
                'sexo' => 'm',
                'apellido' => 'Rangel Colmenares',
                'nombre' => 'Luiscarlos',
                'email' => 'luiscarlosrc1996@hotmail.com',
                'telefono_movil' => '04243641280',
                'telefono_fijo' => '02272676021',
                'curriculum' => 'curriculum',
                'vacante_id' => 8,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 30917694,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1976-04-15',
                'sexo' => 'f',
                'apellido' => 'Marcano Francechi',
                'nombre' => 'Nickol',
                'email' => 'nickol76mf@hotmail.com',
                'telefono_movil' => '04128301543',
                'telefono_fijo' => '02618751020',
                'curriculum' => 'curriculum',
                'vacante_id' => 8,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 12687215,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1975-05-11',
                'sexo' => 'm',
                'apellido' => 'Castañeda Rivero',
                'nombre' => 'José',
                'email' => 'jose1975cr05@hotmail.com',
                'telefono_movil' => '04128637412',
                'telefono_fijo' => '02457812654',
                'curriculum' => 'curriculum',
                'vacante_id' => 8,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 14873002,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1978-12-01',
                'sexo' => 'f',
                'apellido' => 'Chópite Arcia',
                'nombre' => 'Daniela',
                'email' => 'danielaca1978@hotmail.com',
                'telefono_movil' => '04247452035',
                'telefono_fijo' => '02689821454',
                'curriculum' => 'curriculum',
                'vacante_id' => 8,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            // vacantes 9
            DB::table('aspirantes')->insert([
                'cedula' => 18233557,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1989-09-22',
                'sexo' => 'm',
                'apellido' => 'Henriquez Román',
                'nombre' => 'Wilfredo',
                'email' => 'hrwilfredo@hotmail.com',
                'telefono_movil' => '04126322487',
                'telefono_fijo' => '02936542269',
                'curriculum' => 'curriculum',
                'vacante_id' => 9,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 22687521,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1993-11-23',
                'sexo' => 'm',
                'apellido' => 'Márquez Sánchez',
                'nombre' => 'Jhoan',
                'email' => 'jhoanms93@hotmail.com',
                'telefono_movil' => '04260359874',
                'telefono_fijo' => '02634520122',
                'curriculum' => 'curriculum',
                'vacante_id' => 9,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 17321596,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-10-01',
                'sexo' => 'f',
                'apellido' => 'Mundaray Cumana',
                'nombre' => 'Mileidys',
                'email' => 'mcMileidys90@hotmail.com',
                'telefono_movil' => '04122328741',
                'telefono_fijo' => '02349658412',
                'curriculum' => 'curriculum',
                'vacante_id' => 9,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 13854632,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1977-08-02',
                'sexo' => 'm',
                'apellido' => 'González Maestre',
                'nombre' => 'Luís',
                'email' => 'luis77gm@hotmail.com',
                'telefono_movil' => '04141456221',
                'telefono_fijo' => '02249012248',
                'curriculum' => 'curriculum',
                'vacante_id' => 9,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            // vacantes 10
            DB::table('aspirantes')->insert([
                'cedula' => 11057463,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1966-06-13',
                'sexo' => 'f',
                'apellido' => 'Rojas Arenas',
                'nombre' => 'Verónica',
                'email' => 'mra66verónica@hotmail.com',
                'telefono_movil' => '04268523010',
                'telefono_fijo' => '02642013650',
                'curriculum' => 'curriculum',
                'vacante_id' => 10,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 14680301,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1979-08-18',
                'sexo' => 'f',
                'apellido' => 'Bastardo Tineo',
                'nombre' => 'Rosa',
                'email' => 'bt79rosa@hotmail.com',
                'telefono_movil' => '04262004579',
                'telefono_fijo' => '02126852227',
                'curriculum' => 'curriculum',
                'vacante_id' => 10,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 16691001,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1982-03-20',
                'sexo' => 'm',
                'apellido' => 'Márquez Landaeta',
                'nombre' => 'José',
                'email' => 'jose82ml20@hotmail.com',
                'telefono_movil' => '04246842014',
                'telefono_fijo' => '02682401121',
                'curriculum' => 'curriculum',
                'vacante_id' => 10,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15796322,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1981-05-26',
                'sexo' => 'f',
                'apellido' => 'Yendiz Rivas',
                'nombre' => 'Carmen',
                'email' => 'carmenyendiz81@hotmail.com',
                'telefono_movil' => '04263641226',
                'telefono_fijo' => '02942244867',
                'curriculum' => 'curriculum',
                'vacante_id' => 10,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            // vacantes 11
            DB::table('aspirantes')->insert([
                'cedula' => 19000224,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1989-07-13',
                'sexo' => 'f',
                'apellido' => 'Luna Fernández',
                'nombre' => 'Zorianny',
                'email' => 'zorianny89lf@hotmail.com',
                'telefono_movil' => '04168745212',
                'telefono_fijo' => '02249742823',
                'curriculum' => 'curriculum',
                'vacante_id' => 11,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 8635269,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1967-09-14',
                'sexo' => 'm',
                'apellido' => 'Patiño Brito',
                'nombre' => 'Darwing',
                'email' => '1967darwingpb@hotmail.com',
                'telefono_movil' => '04122589856',
                'telefono_fijo' => '02953642214',
                'curriculum' => 'curriculum',
                'vacante_id' => 11,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 10236411,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1973-04-01',
                'sexo' => 'm',
                'apellido' => 'González Maestre',
                'nombre' => 'Luis',
                'email' => 'gonmaesluis@hotmail.com',
                'telefono_movil' => '04263024571',
                'telefono_fijo' => '02647955462',
                'curriculum' => 'curriculum',
                'vacante_id' => 11,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 5362248,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1971-09-11',
                'sexo' => 'm',
                'apellido' => 'Figueroa Castañeda',
                'nombre' => 'Cristhian',
                'email' => 'cristhianfc1971@hotmail.com',
                'telefono_movil' => '04246910231',
                'telefono_fijo' => '02126954187',
                'curriculum' => 'curriculum',
                'vacante_id' => 11,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            // vacantes 12
            DB::table('aspirantes')->insert([
                'cedula' => 8651999,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1968-11-16',
                'sexo' => 'm',
                'apellido' => 'Florez Guevara',
                'nombre' => 'Fernando',
                'email' => 'fernando1968@hotmail.com',
                'telefono_movil' => '04268750215',
                'telefono_fijo' => '02952155146',
                'curriculum' => 'curriculum',
                'vacante_id' => 12,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 16745632,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1984-02-27',
                'sexo' => 'f',
                'apellido' => 'Veliz Sánchez',
                'nombre' => 'Daliuska',
                'email' => '1984daliuska@hotmail.com',
                'telefono_movil' => '04123654200',
                'telefono_fijo' => '02123640450',
                'curriculum' => 'curriculum',
                'vacante_id' => 12,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 12310248,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1977-03-01',
                'sexo' => 'm',
                'apellido' => 'Gómez Maneiro',
                'nombre' => 'Gabriel',
                'email' => 'gm77gabriel@hotmail.com',
                'telefono_movil' => '04261024578',
                'telefono_fijo' => '02453674554',
                'curriculum' => 'curriculum',
                'vacante_id' => 12,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 20345870,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1991-05-14',
                'sexo' => 'm',
                'apellido' => 'Córdova Zambrano',
                'nombre' => 'Yofren',
                'email' => 'corzamofren91@hotmail.com',
                'telefono_movil' => '04265487541',
                'telefono_fijo' => '02248478410',
                'curriculum' => 'curriculum',
                'vacante_id' => 12,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
                ]);
            DB::table('aspirantes')->insert([                   //vacante 13
                'cedula' => 17684100,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1986-09-23',
                'sexo' => 'f',
                'apellido' => 'Guevara Cabello',
                'nombre' => 'Carlismar',
                'email' => 'guecabcarlismar86@gmail.com',
                'telefono_movil' => '04142255812',
                'telefono_fijo' => '02914512052',
                'curriculum' => 'curriculum',
                'vacante_id' => 13,
                'cargo_id' => 25,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 11010140,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1975-12-24',
                'sexo' => 'f',
                'apellido' => 'Figuera Rojas',
                'nombre' => 'Angelina',
                'email' => 'angelina75figroj@gmail.com',
                'telefono_movil' => '04168534700',
                'telefono_fijo' => '02934673893',
                'curriculum' => 'curriculum',
                'vacante_id' => 13,
                'cargo_id' => 25,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 17000331,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1986-11-21',
                'sexo' => 'm',
                'apellido' => 'Tenorio Díaz',
                'nombre' => 'Mauricio',
                'email' => 'mauriciotenorio86@gmail.com',
                'telefono_movil' => '04143934580',
                'telefono_fijo' => '02122485484',
                'curriculum' => 'curriculum',
                'vacante_id' => 13,
                'cargo_id' => 25,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 7246921,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1960-03-14',
                'sexo' => 'f',
                'apellido' => 'Mota Rodríguez',
                'nombre' => 'Lorena',
                'email' => '1960lorenamr@gmail.com',
                'telefono_movil' => '04247415651',
                'telefono_fijo' => '02363201245',
                'curriculum' => 'curriculum',
                'vacante_id' => 13,
                'cargo_id' => 25,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
                DB::table('aspirantes')->insert([
                'cedula' => 19224987,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1989-03-22',
                'sexo' => 'm',
                'apellido' => 'Lisboa Ramírez',
                'nombre' => 'José',
                'email' => 'lramirezjose89@gmail.com',
                'telefono_movil' => '02936421817',
                'telefono_fijo' => '04167834720',
                'curriculum' => 'curriculum',
                'vacante_id' => 14,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
                ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15746109,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-12-15',
                'sexo' => 'f',
                'apellido' => 'Cova Roque',
                'nombre' => 'Yolanda',
                'email' => 'coroyolanda80@gmail.com',
                'telefono_movil' => '04263002210',
                'telefono_fijo' => '02934510496',
                'curriculum' => 'curriculum',
                'vacante_id' => 14,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 13002143,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1979-04-18',
                'sexo' => 'f',
                'apellido' => 'Castillo Cova',
                'nombre' => 'Valery',
                'email' => 'valerycasco79@gmail.com',
                'telefono_movil' => '04268510213',
                'telefono_fijo' => '02935214512',
                'curriculum' => 'curriculum',
                'vacante_id' => 14,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 24002689,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-10-01',
                'sexo' => 'm',
                'apellido' => 'Avilé Salaya',
                'nombre' => 'Dionny',
                'email' => 'asdionny4@gmail.com',
                'telefono_movil' => '04261585205',
                'telefono_fijo' => '02945162684',
                'curriculum' => 'curriculum',
                'vacante_id' => 14,
                'cargo_id' => 26,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
                DB::table('aspirantes')->insert([
                'cedula' => 19301400,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-09-30',
                'sexo' => 'm',
                'apellido' => 'Torres Fuentes',
                'nombre' => 'Victor',
                'email' => 'futovictor90@gmail.com',
                'telefono_movil' => '04247549326',
                'telefono_fijo' => '02816845723',
                'curriculum' => 'curriculum',
                'vacante_id' => 15,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
            DB::table('aspirantes')->insert([
                'cedula' => 16763005,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1984-10-28',
                'sexo' => 'f',
                'apellido' => 'Maestre Márquez',
                'nombre' => 'Beletxy',
                'email' => 'mm2beletxy@gmail.com',
                'telefono_movil' => '04124128930',
                'telefono_fijo' => '02368745215',
                'curriculum' => 'curriculum',
                'vacante_id' => 15,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 21002147,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1992-07-21',
                'sexo' => 'f',
                'apellido' => 'Bastardo Molina',
                'nombre' => 'Bianca',
                'email' => 'bm3bianca92@gmail.com',
                'telefono_movil' => '04268521030',
                'telefono_fijo' => '02468745455',
                'curriculum' => 'curriculum',
                'vacante_id' => 15,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 18000002,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1987-06-05',
                'sexo' => 'f',
                'apellido' => 'Parejo Zapata',
                'nombre' => 'Daniela',
                'email' => 'danielapz87@gmail.com',
                'telefono_movil' => '04143658210',
                'telefono_fijo' => '02128672223',
                'curriculum' => 'curriculum',
                'vacante_id' => 15,
                'cargo_id' => 21,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
                DB::table('aspirantes')->insert([
                'cedula' => 7159749,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1961-01-01',
                'sexo' => 'm',
                'apellido' => 'Ramos Guerra',
                'nombre' => 'Andres',
                'email' => 'andres61rg@gmail.com',
                'telefono_movil' => '04160218745',
                'telefono_fijo' => '02740459632',
                'curriculum' => 'curriculum',
                'vacante_id' => 16,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
            DB::table('aspirantes')->insert([
                'cedula' => 14597057,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1979-12-29',
                'sexo' => 'm',
                'apellido' => 'Martínez Rodríguez',
                'nombre' => 'Leonel',
                'email' => 'leonelmr79@gmail.com',
                'telefono_movil' => '04162304711',
                'telefono_fijo' => '02953648483',
                'curriculum' => 'curriculum',
                'vacante_id' => 16,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 22046954,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1992-05-17',
                'sexo' => 'm',
                'apellido' => 'Lara Torrealba',
                'nombre' => 'Mario',
                'email' => 'mario92@gmail.com',
                'telefono_movil' => '04263659842',
                'telefono_fijo' => '02946958461',
                'curriculum' => 'curriculum',
                'vacante_id' => 16,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15238754,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-12-31',
                'sexo' => 'f',
                'apellido' => 'Velásquez Prada',
                'nombre' => 'Patricia',
                'email' => 'veprapatricia80@gmail.com',
                'telefono_movil' => '04146548942',
                'telefono_fijo' => '02124887965',
                'curriculum' => 'curriculum',
                'vacante_id' => 16,
                'cargo_id' => 22,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
                DB::table('aspirantes')->insert([
                'cedula' => 26348751,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1997-06-22',
                'sexo' => 'm',
                'apellido' => 'Carvajal Velásquez',
                'nombre' => 'Valentino',
                'email' => 'valentinocarve97@gmail.com',
                'telefono_movil' => '04241456307',
                'telefono_fijo' => '02934844988',
                'curriculum' => 'curriculum',
                'vacante_id' => 17,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
            DB::table('aspirantes')->insert([
                'cedula' => 16236749,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1982-05-01',
                'sexo' => 'f',
                'apellido' => 'Zapata Arteaga',
                'nombre' => 'Eliannys',
                'email' => 'eliannys82zaar@gmail.com',
                'telefono_movil' => '04162248552',
                'telefono_fijo' => '02956545456',
                'curriculum' => 'curriculum',
                'vacante_id' => 17,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
                ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15000333,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-07-11',
                'sexo' => 'm',
                'apellido' => 'Mendoza Vidal',
                'nombre' => 'Antulio',
                'email' => 'mendez3@gmail.com',
                'telefono_movil' => '02936421817',
                'telefono_fijo' => '04167834720',
                'curriculum' => 'curriculum',
                'vacante_id' => 17,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 156788760,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-01-23',
                'sexo' => 'f',
                'apellido' => 'Navarro Gómez',
                'nombre' => 'Jesús',
                'email' => 'navarrito@gmail.com',
                'telefono_movil' => '04246817567',
                'telefono_fijo' => '02677839898',
                'curriculum' => 'curriculum',
                'vacante_id' => 17,
                'cargo_id' => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
                DB::table('aspirantes')->insert([
                'cedula' => 14543123,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1989-02-28',
                'sexo' => 'm',
                'apellido' => 'Bolívar Blanco',
                'nombre' => 'Roberto Antonio',
                'email' => 'robertobb@gmail.com',
                'telefono_movil' => '04127876565',
                'telefono_fijo' => '02719874720',
                'curriculum' => 'curriculum',
                'vacante_id' => 18,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            
DB::table('aspirantes')->insert([
                'cedula' => 14567765,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-06-30',
                'sexo' => 'f',
                'apellido' => 'Bruzual',
                'nombre' => 'Neleida',
                'email' => 'neleida@gmail.com',
                'telefono_movil' => '04260161817',
                'telefono_fijo' => '02720987654',
                'curriculum' => 'curriculum',
                'vacante_id' => 18,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 16226003,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-09-08',
                'sexo' => 'f',
                'apellido' => 'Gaspar',
                'nombre' => 'Kanrosy',
                'email' => 'kanrosyg@gmail.com',
                'telefono_movil' => '04166383808',
                'telefono_fijo' => '02394720099',
                'curriculum' => 'curriculum',
                'vacante_id' => 18,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')           
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15444333,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-12-02',
                'sexo' => 'f',
                'apellido' => 'Brito',
                'nombre' => 'Pablo José',
                'email' => 'pablobrito@gmail.com',
                'telefono_movil' => '04265431817',
                'telefono_fijo' => '02267834345',
                'curriculum' => 'curriculum',
                'vacante_id' => 18,
                'cargo_id' => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            // vacantes renzo
            // vacantes 19
            DB::table('aspirantes')->insert([
                'cedula' => 16900003,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-03-19',
                'sexo' => 'f',
                'apellido' => 'Rodriguez Quintana',
                'nombre' => 'Anna Giselle',
                'email' => 'annagiselle@gmail.com',
                'telefono_movil' => '04242174543',
                'telefono_fijo' => '02396788888',
                'curriculum' => 'curriculum',
                'vacante_id' => 19,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15600002,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1993-01-09',
                'sexo' => 'm',
                'apellido' => 'Contreras',
                'nombre' => 'Arquímedes',
                'email' => 'arquimedesc@hotmail.com',
                'telefono_movil' => '04246421907',
                'telefono_fijo' => '02427171777',
                'curriculum' => 'curriculum',
                'vacante_id' => 19,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 10111001,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-01-27',
                'sexo' => 'm',
                'apellido' => 'Ávila Hernández',
                'nombre' => 'Ignacio Alí',
                'email' => 'ignacioali@hotmail.com',
                'telefono_movil' => '04268111213',
                'telefono_fijo' => '02127814722',
                'curriculum' => 'curriculum',
                'vacante_id' => 19,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 10123456,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1984-04-16',
                'sexo' => 'm',
                'apellido' => 'Montilla Palomo',
                'nombre' => 'Andrés Eloy',
                'email' => 'andreseloy@hotmail.com',
                'telefono_movil' => '04268171727',
                'telefono_fijo' => '02953314720',
                'curriculum' => 'curriculum',
                'vacante_id' => 19,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            // vacantes 20
            DB::table('aspirantes')->insert([
                'cedula' => 1544433,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1993-08-12',
                'sexo' => 'f',
                'apellido' => 'Márquez Bruzual',
                'nombre' => 'Verónica Andreína',
                'email' => 'verovero@hotmail.com',
                'telefono_movil' => '04164299917',
                'telefono_fijo' => '02267834720',
                'curriculum' => 'curriculum',
                'vacante_id' => 20,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')  
                ]);
            DB::table('aspirantes')->insert([
                'cedula' => 18098765,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1994-10-24',
                'sexo' => 'f',
                'apellido' => 'Zurita',
                'nombre' => 'Luisangeli',
                'email' => 'luisangeli@gmail.com',
                'telefono_movil' => '04129898980',
                'telefono_fijo' => '02122128877',
                'curriculum' => 'curriculum',
                'vacante_id' => 20,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 17098765,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-07-01',
                'sexo' => 'f',
                'apellido' => 'Lanza Longart',
                'nombre' => 'Noryeling Luisana',
                'email' => 'norye@gmail.com',
                'telefono_movil' => '04166543020',
                'telefono_fijo' => '02124720011',
                'curriculum' => 'curriculum',
                'vacante_id' => 20,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 18999000,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1979-11-23',
                'sexo' => 'm',
                'apellido' => 'Zorrilla',
                'nombre' => 'Luis Antonio',
                'email' => 'luiszorrilla@hotmail.com',
                'telefono_movil' => '04122451817',
                'telefono_fijo' => '04167829898',
                'curriculum' => 'curriculum',
                'vacante_id' => 20,
                'cargo_id' => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            // vacantes 21
            DB::table('aspirantes')->insert([
                'cedula' => 14777666,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1993-10-20',
                'sexo' => 'm',
                'apellido' => 'Blanco Carvajal',
                'nombre' => 'Ricardo José',
                'email' => 'ricardito@hotmail.com',
                'telefono_movil' => '04126421817',
                'telefono_fijo' => '02254720011',
                'curriculum' => 'curriculum',
                'vacante_id' => 21,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 17676788,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1989-12-26',
                'sexo' => 'f',
                'apellido' => 'Ruiz',
                'nombre' => 'Yubanny',
                'email' => 'yubita@hotmail.com',
                'telefono_movil' => '04126421817',
                'telefono_fijo' => '02864321112',
                'curriculum' => 'curriculum',
                'vacante_id' => 21,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 20987654,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1996-06-11',
                'sexo' => 'm',
                'apellido' => 'Pérez',
                'nombre' => 'Franklin',
                'email' => 'fperez@gmail.com',
                'telefono_movil' => '04126421817',
                'telefono_fijo' => '02416834721',
                'curriculum' => 'curriculum',
                'vacante_id' => 21,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 13598200,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-05-01',
                'sexo' => 'f',
                'apellido' => 'Salazar',
                'nombre' => 'Yamilet',
                'email' => 'yamilet@hotmail.com',
                'telefono_movil' => '04126789101',
                'telefono_fijo' => '02417834720',
                'curriculum' => 'curriculum',
                'vacante_id' => 21,
                'cargo_id' => 18,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            // vacantes 22
            DB::table('aspirantes')->insert([
                'cedula' => 16123321,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1993-02-24',
                'sexo' => 'm',
                'apellido' => 'Hernández',
                'nombre' => 'Juan',
                'email' => 'juanh@hotmail.com',
                'telefono_movil' => '04147775553',
                'telefono_fijo' => '02812810909',
                'curriculum' => 'curriculum',
                'vacante_id' => 22,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 16767999,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1995-09-04',
                'sexo' => 'F',
                'apellido' => 'Salazar',
                'nombre' => 'Yaritza',
                'email' => 'yari1370@gmail.com',
                'telefono_movil' => '04147776668',
                'telefono_fijo' => '02934313131',
                'curriculum' => 'curriculum',
                'vacante_id' => 22,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15123456,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1992-03-21',
                'sexo' => 'm',
                'apellido' => 'González',
                'nombre' => 'Francisco',
                'email' => 'francisco@hotmail.com',
                'telefono_movil' => '04160112131',
                'telefono_fijo' => '02917678989',
                'curriculum' => 'curriculum',
                'vacante_id' => 22,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 12222333,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-03-19',
                'sexo' => 'm',
                'apellido' => 'Vallejo',
                'nombre' => 'José',
                'email' => 'josevallejo@hotmail.com',
                'telefono_movil' => '04169991011',
                'telefono_fijo' => '02934314151',
                'curriculum' => 'curriculum',
                'vacante_id' => 22,
                'cargo_id' => 19,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
            // vacantes 23
            DB::table('aspirantes')->insert([
                'cedula' => 15444666,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1991-05-15',
                'sexo' => 'f',
                'apellido' => 'Longart',
                'nombre' => 'Cádiz',
                'email' => 'cadita@hotmail.com',
                'telefono_movil' => '04141515123',
                'telefono_fijo' => '02934311010',
                'curriculum' => 'curriculum',
                'vacante_id' => 23,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 16123345,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1974-05-31',
                'sexo' => 'm',
                'apellido' => 'Villegas',
                'nombre' => 'Edgar',
                'email' => 'edgarv@hotmail.com',
                'telefono_movil' => '04245181818',
                'telefono_fijo' => '02930998877',
                'curriculum' => 'curriculum',
                'vacante_id' => 23,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15777666,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1984-04-02',
                'sexo' => 'm',
                'apellido' => 'Lanza',
                'nombre' => 'Alfredo',
                'email' => 'alfredolanza@gmail.com',
                'telefono_movil' => '04248886667',
                'telefono_fijo' => '02934312020',
                'curriculum' => 'curriculum',
                'vacante_id' => 23,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 13234432,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-12-12',
                'sexo' => 'f',
                'apellido' => 'Merceluz',
                'nombre' => 'Caraballo',
                'email' => 'mercecaraballo@hotmail.com',
                'telefono_movil' => '04246421888',
                'telefono_fijo' => '02934317123',
                'curriculum' => 'curriculum',
                'vacante_id' => 23,
                'cargo_id' => 8,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            // vacantes 24
            DB::table('aspirantes')->insert([
                'cedula' => 22333123,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1995-08-01',
                'sexo' => 'm',
                'apellido' => 'Sánchez',
                'nombre' => 'Alberto',
                'email' => 'albertosanchez@gmail.com',
                'telefono_movil' => '04166421817',
                'telefono_fijo' => '02937834720',
                'curriculum' => 'curriculum',
                'vacante_id' => 24,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 15089185,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-11-08',
                'sexo' => 'f',
                'apellido' => 'Marcano',
                'nombre' => 'Nancy',
                'email' => 'nancita@hotmail.com',
                'telefono_movil' => '04167834720',
                'telefono_fijo' => '02937213995',
                'curriculum' => 'curriculum',
                'vacante_id' => 24,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 10549671,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1975-05-21',
                'sexo' => 'm',
                'apellido' => 'Navas',
                'nombre' => 'Luis',
                'email' => 'Luisalfredo@hotmail.com',
                'telefono_movil' => '04163960279',
                'telefono_fijo' => '02934332040',
                'curriculum' => 'curriculum',
                'vacante_id' => 24,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);
            DB::table('aspirantes')->insert([
                'cedula' => 13598082,
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1977-05-21',
                'sexo' => 'f',
                'apellido' => 'Carvajal',
                'nombre' => 'Alejandra',
                'email' => 'acarvajal@gmail.com',
                'telefono_movil' => '04163282868',
                'telefono_fijo' => '02937213995',
                'curriculum' => 'curriculum',
                'vacante_id' => 24,
                'cargo_id' => 9,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')            
            ]);        

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
