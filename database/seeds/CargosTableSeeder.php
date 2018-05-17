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
                'titulo'                => 'Director operaciones aéreas',
                'perfil'                => '<h2>DIRECTOR DE OPERACIONES AÉREAS</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Planear, coordinar y controlar las actividades pertinentes para el desarrollo de operaciones aéreas seguras, eficaces y eficientes.</p>

<h4>EDUCACIÓN:</h4>
<p>Oficial activo o retirado de la FAV (PILOTO) o Título Profesional en Administración Aeronáutica.</p>
<p>Conocimientos en los Reglamentos Aeronáuticos de Venezuela.</p>

<h4>EXPERIENCIA:</h4>
<p>Requisito Básico para Personal Civil</p>
<p>La Dirección de Operaciones Aéreas es desempeñada por un piloto de transporte de línea con</p>
<p>mínimo tres (3) años de experiencia como piloto al mando de aeronaves de pistón, turbohélices o jets.</p>

Requisito Básico para Personal FAV
<p>La Dirección de Operaciones Aéreas es desempeñada por un Oficial Superior (de Grado Mayor</p>
<p>en adelante), con mínimo tres (3) años de experiencia como piloto al mando de aeronaves de pistón, turbohélices o jets.</p>
',
                'funciones'             => '<li>Conocer y aplicar lo concerniente a lo establecido en los Reglamentos Aeronáuticos de Venezuela</li>
<li>Supervisar que las operaciones de vuelo, se lleven a cabo bajo los estándares de las regulaciones nacionales e internacionales.</li>
<li>Hacer cumplir las regulaciones impuestas por la F.A.V, Aeronáutica Civil en lo relacionado con las operaciones aéreas.</li>
<li>Asistir a la Presidencia en la formulación de los planes y programas relacionados con las operaciones aéreas de la Empresa.</li>',
                'tabulador_salarial_id' => 24,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Secretaria ejecutiva',
                'perfil'                => '<h2>SECRETARIA EJECUTIVA</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Ejecutar labores de oficina y de asistencia administrativa, facilitando la ejecución de las actividades y procesos</p> <p>de la Dependencia, brindando apoyo oportuno al grupo de trabajo.</p>

<h4>EDUCACIÓN:</h4>
<p>Bachillerato, curso de secretariado ejecutivo o Secretariado Comercial.</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia específica.</p>',
                'funciones'             => '<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Leer, revisar y tramitar diariamente los correos electrónicos institucionales.</li>
<li>Recepcionar, revisar y tramitar los documentos allegados a la Oficina Jurídica para la atención oportuna de los mismos.</li>
<li>Entregar oportunamente los documentos gestionados, revisados y formalizados por la Oficina Jurídica a los destinatarios y Dependencias relacionadas con el asunto.</li>
<li>Atender y orientar al cliente interno y externo.</li>',
                'tabulador_salarial_id' => 2,
                'area_id'               => 4,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Coordinador de rampa y despacho',
                'perfil'                => '<h2>COORDINADOR DE RAMPA Y DESPACHO</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Ejercer control y supervisión de las actividades que se realizan en el despacho de las aeronaves, garantizando el </p><p>cumplimiento de los itinerarios en forma segura y eficiente de acuerdo a la programación emitida por la Dirección de Operaciones Aéreas.</p>

<h4>EDUCACIÓN:</h4>
<p>Técnico Profesional en Administración de Aerolíneas.</p>

<h4>EXPERIENCIA:</h4>
<p>Dos (2) años en labores relacionadas con operaciones aéreas, ingeniería de operaciones y/o despacho de aeronaves.</p>',
                'funciones'             => '<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Velar por la eficiencia en los procesos y procedimientos vigentes, para que el despacho de las aeronaves se materialice en el cumplimiento seguro de los itinerarios, aeronaves y buen servicio al pasajero.</li>
<li>Llevar el control de la facturación que se lleva a cabo con respecto al contrato de asistencia en tierra.</li>
<li>Mantener al día la parte administrativa de la Dependencia en cuanto a archivo, correos electrónicos, solicitudes de pedidos de útiles para el cumplimiento de las funciones en el Área Despacho.</li>
<li>Llevar el manejo y supervisión de los equipajes rezagados en los diferentes vuelos.</li>',
                'tabulador_salarial_id' => 2,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Gestor de calidad',
                'perfil'                => '',
                'funciones'             => '',
                'tabulador_salarial_id' => 15,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Gestor de aeronáutica civil',
                'perfil'                => '<h2>GESTOR AERONÁUTICA CIVIL</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Dirigir los procedimientos concernientes a Certificación o adición de Aeronaves ante la Aeronáutica Civil, así </p><p>mismo atender todos los temas relacionados con la Aeronáutica Civil específicamente con la parte de operación de aeronaves.</p>

<h4>EDUCACIÓN:</h4>
<p>Título de Especialización en áreas afines al sector Aeronáutico o su Equivalencia.</p>
<p>Equivalencia: Título de especialización por tres (3) años de experiencia profesional relacionada, adicional a la requerida por el cargo.</p>
<p>Auditor interno de Calidad.</p>

<h4>EXPERIENCIA:</h4>
<p>Dos (2) años en áreas de operaciones de empresas de aviación.</p>',
                'funciones'             => '<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Divulgar y dar a conocer la misión y objetivos de la Dirección encaminados hacia los procesos de Certificación U.A.E.A.C</li>
<li>Plantear cursos de acción al Director de Operaciones Aéreas de acuerdo a los lineamientos establecidos por la U.A.E.A.C para llevar a cabo el Proceso de Certificación.</li>
<li>Mantener actualizados los manuales respectivos (M.G.O.) todos los conceptos, políticas y procedimientos de los R.A.C.</li>
<li>Hacer una oportuna divulgación y conocimiento de los manuales que forman parte del M.G.O. a través de capacitaciones y socialización de temas a nivel nacional con los agentes comerciales vinculados a la Empresa y todo el personal de la Dirección de Operaciones Aéreas</li>',
                'tabulador_salarial_id' => 15,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Analista operacional de flota',
                'perfil'                => '',
                'funciones'             => '',
                'tabulador_salarial_id' => 15,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Estandarizador equipos operados por AVCA',
                'perfil'                => '',
                'funciones'             =>'',
                'tabulador_salarial_id' => 16,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Piloto ',
                'perfil'                => '<h2>PILOTO</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4> <p>Cumplir con la programación de vuelo efectuada por la Dirección de Operaciones Aéreas, llevando a cabo las operaciones aéreas de manera efectiva,</p><p> eficaz, eficiente y segura, a través de parámetros de estandarización y entrenamiento.</p>

<h4>EDUCACIÓN:</h4>
Requisitos de acuerdo al MRPT (Manual de Requisitos y Procedimientos Para Tripulantes) 
Piloto Militar
<li>Graduarse como oficial piloto de la Escuela Militar de Aviación.</li>
<li>Aprobar curso de transición en equipo a volar con nota superior al 85%.</li>
Piloto Civil
<li>Licencia de Piloto Comercial (Piloto Transporte de Línea, PTL).</li>
<li>Aprobar curso de transición en equipo a volar con nota superior al 85%.</li>
.

<h4>EXPERIENCIA:</h4>
<p>Poseer requisitos mínimos de experiencia de vuelo tales como:</p>
<p>EMBRAER 145 / EMBRAER 170 / ATR 42-72 / Y-12E
<p>Requisitos mínimos establecidos en los Reglamentos Aeronáuticos </p>
<li>Para Pilotos certificar PCA +1.500 horas</li>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>PILOTO AL MANDO.</li>
<p>Posición del piloto al mando</p>
<p>El Piloto al mando es el responsable de la seguridad de los pasajeros, tripulación y carga, durante el tiempo de vuelo y esta cube:</p>
<li>A los miembros de la tripulación bajo su mando o destacados en comisión.</li>
<li>Así como a todos los demás ocupantes de la aeronave desde el momento en que se cierren las
puertas de acceso de la aeronave hasta su apertura.</li>',
                'tabulador_salarial_id' => 19,
                'area_id'               => 6,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Copiloto ',
                'perfil'                => '<h2>COPILOTO</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4> <p>Cumplir con la programación de vuelo efectuada por la Dirección de Operaciones Aéreas, llevando a cabo las operaciones </p><p>aéreas de manera efectiva, eficaz, eficiente y segura, a través de parámetros de estandarización y entrenamiento.</p>

<h4>EDUCACIÓN:</h4>
<p>Requisitos de acuerdo al MRPT (Manual de Requisitos y Procedimientos Para Tripulantes) </p>

Copiloto Militar
<li>Graduarse como oficial piloto de la Escuela Militar de Aviación.</li>
<li>Aprobar curso de transición en equipo a volar con nota superior al 85%.</li>
Copiloto Civil
<li>Licencia de Piloto Comercial (Piloto Comercial Aviones PCA).</li>
<li>Aprobar curso de transición en equipo a volar con nota superior al 85%.</li>

<p>NOTA: Cumplir con 30 horas de observador en el equipo a volar sin importar el cargo a desempeñar.</p>

<h4>EXPERIENCIA:</h4>
<p>Poseer requisitos mínimos de experiencia de vuelo tales como:
EMBRAER 145 / EMBRAER 170 / ATR 42-72 / Y-12E</p>
<p>Requisitos mínimos establecidos en los Reglamentos Aeronáuticos </p>
<li>Para Copilotos certificar 200 horas.</li>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:<h4>
<li>Recolectar y completar la información actualizada y necesaria para el vuelo, referente a cartas de ruta y aproximación, reportes meteorológicos, Notams, etc.</li>
<li>Elaborar y presentar el plan de vuelo en aquellos aeropuertos donde la Empresa no cuente con despachador autorizado para realizarlo.</li>
<li>Asumir el mando de la aeronave en el evento de incapacidad del Piloto para continuar el vuelo.</li>
<li>Ser la segunda autoridad a bordo durante el desarrollo del vuelo, colaborando con el Piloto para la operación de la aeronave dentro de los parámetros y limitaciones pre- establecidos.</li>',
                'tabulador_salarial_id' => 18,
                'area_id'               => 6,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Auxiliar de servicio abordo',
                'perfil'                => '',
                'funciones'             =>'',
                'tabulador_salarial_id' => 13,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Despachador de aviones',
                'perfil'                => '<h2>DESPACHADOR DE AVIONES</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Realizar los despachos remotos que estén debidamente solicitados por las agencias a nivel nacional, así mismo estandarizar los procedimientos,</p><p> instructivos o manuales requeridos para el despacho eficiente y seguro de las aeronaves de la Empresa.</p>

<h4>EDUCACIÓN:</h4>
<p>Técnico en despacho de aeronaves.</p>
<p>Licencia DPA</p>

<h4>EXPERIENCIA:</h4>
<p>Haber ejercido funciones en el Área de Despacho de aeronaves en un espacio no inferior a seis (6) meses, igualmente se considera el tiempo de pasantía como experiencia.</p>


',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Organizar el archivo y registro de los despachos remotos para efectuar el posterior informe y cobro por parte de las agencias comerciales</li>
<li>Llevar las estadísticas de los despachos remotos.</li>
<li>Reportar diariamente a los coordinadores del despacho cualquier novedad que se presente en el proceso de despachos remotos.</li>
<li>Servir de enlace entre el Área de Ingeniería de Operaciones y Despacho.</li>',
                'tabulador_salarial_id' => 11,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Despachador instructor',
                'perfil'                => '<h2>DESPACHADOR INSTRUCTOR</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Formar, instruir, actualizar y preparar al personal de despachadores en el conocimiento de normas y procesos para el desarrollo de las labores como </p><p>despachador de aeronaves garantizando eficiencia y seguridad en la operación aérea.</p>

<h4>EDUCACIÓN:</h4>
<p>Los funcionarios designados como Despachador Instructor, deben cumplir con los siguientes
requisitos adicionales:</p>
<p>IET (instructor en tierra de especialidades aeronáuticas)</p>

<h4>EXPERIENCIA:</h4>
<p>Los funcionarios designados como Despachador Instructor, deben cumplir con los siguientes
requisitos adicionales:</p>
<p>Licencia DPA, con la adición de todos los equipos que opera la Empresa. Para ser promovido como instructor debe tener mínimo tres (3) años ejerciendo las funciones de Despachador en la Empresa.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Respetar y hacer respetar las normas nacionales e internacionales en lo que respecta al despacho de aeronaves</li>
<li>Controlar y vigilar el cumplimiento de la normatividad aplicable en su área de actividad.</li>
<li>Estudiar, elaborar y distribuir la normativa y documento relativos a su área de actividad.</li>
<li>Ejecutar las funciones asignadas en los procedimientos del aeropuerto dentro de su área de actividad.</li>',
                'tabulador_salarial_id' => 12,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Auxiliar de despacho',
                'perfil'                => '<h2>AUXILIAR DE DESPACHO</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Supervisar y controlar la preservación y entrega de los equipajes a los pasajeros evitando pérdidas y reclamos; también la conexión entre las diferentes dependencias aeroportuarias.</p>

<h4>EDUCACIÓN:</h4>
<p>Bachiller Técnico o Comercial.</p>

<h4>EXPERIENCIA:</h4>
<p>Seis (6) meses de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Verificar con el administrador del aeropuerto, la banda que será asignada para la entrega de equipaje.</li>
<li>Manipular la banda para empezar la entrega o término del equipaje.</li>
<li>Recibir por parte del tractorista la planilla de relación de equipaje abordado.</li>
<li>Solicitar a los viajeros las colillas del equipaje y verificar que corresponda el número del tag que lleva cada maleta.</li>',
                'tabulador_salarial_id' => 1,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Estadistica centro control de operaciones',
                'perfil'                => '',
                'funciones'             =>'',
                'tabulador_salarial_id' => 1,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Auxiliar equipo terrestre de apoyo aeronautico',
                'perfil'                => '<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Operar los equipos de radio de acuerdo con los procedimientos radiotelefónicos, permaneciendo en contacto con las aeronaves en vuelo.</li>
<li>Estar a la escucha una hora antes de la salida del primer vuelo y permanecer atento a las frecuencias V.H.F. y H.F. hasta la llegada del último vuelo.</li>
<li>Tramitar oportunamente los requerimientos del servicio.</li>
<li>Informar oportunamente cualquier novedad ocurrida durante el servicio al equipo del CCO y Dirección de Operaciones Aéreas.</li>',
                'funciones'             =>'',
                'tabulador_salarial_id' => 1,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Operador de radio',
                'perfil'                => '<h2>OPERADOR DE RADIO</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Realizar la recepción, diligencia y retransmisión de datos y novedades de la operación aérea a nivel nacional.</p>

<h4>EDUCACIÓN:</h4>
<p>Bachiller Comercial o Técnico</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia relacionada.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Operar los equipos de radio de acuerdo con los procedimientos radiotelefónicos, permaneciendo en contacto con las aeronaves en vuelo.</li>
<li>Estar a la escucha una hora antes de la salida del primer vuelo y permanecer atento a las frecuencias V.H.F. y H.F. hasta la llegada del último vuelo.</li>
<li>Tramitar oportunamente los requerimientos del servicio.</li>
<li>Informar oportunamente cualquier novedad ocurrida durante el servicio al equipo del CCO y Dirección de Operaciones Aéreas.</li>',
                'tabulador_salarial_id' => 5,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Técnico gestión entrenamiento pilotos',
                'perfil'                => '<h2>TÉCNICO GESTIÓN ENTRENAMIENTO PILOTOS</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Elaborar toda la documentación necesaria para mantener los requisitos mínimos exigidos por la Aeronáutica Civil Venezolana de las tripulaciones de vuelo de la Empresa.</p>

<h4>EDUCACIÓN:</h4>
<p>Bachiller comercial o técnico.</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Coordinar el trámite para los simuladores de vuelo.</li>
<li>Solicitar a la Presidencia la autorización del entrenamiento (por cada uno de los equipos).</li>
<li>Enviar a Gestión del Talento Humano la planilla de viáticos por la duración de la comisión (por cada uno de los equipos).</li>
<li>Solicitar a la Aeronáutica Civil inspectores cuando se programen iniciales, cursos de instructores, chequeos de proeficiencia y chequeos finales de ruta.</li>',
                'tabulador_salarial_id' => 3,
                'area_id'               => 3,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            //nuevos creados,
            [
                'titulo'                => 'Jefe de sistemas',
                'perfil'                => '<h2>JEFE DE SISTEMAS</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Planificar, supervisar y garantizar la infraestructura de software y hardware, prevista e instalada en AVCA.</p>

<h4>EDUCACIÓN:</h4>
<p>Título Profesional en Sistemas o Telecomunicaciones o Informática.</p>
<p>Especialización en áreas relacionadas a las funciones específicas del cargo o su Equivalencia.</p>
<p>Equivalencia: Título de especialización por tres (3) años de experiencia profesional relacionada, adicional a la requerida por el cargo.</p>

<h4>EXPERIENCIA:</h4>
<p>Tres (3) años en cargos específicos.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Desarrollar normas, procedimientos y estructuras organizacionales, planificando, ejecutando y controlando las actividades de análisis de métodos de trabajo, de procedimientos técnicos y administrativos, a fin de lograr el eficiente aprovechamiento de los recursos de la Empresa y la optimización en sus procesos.</li>
<li>Proponer a la Jefatura de Telemática la normatividad con la cual se administra la infraestructura de software y hardware instalada en AVCA.</li>
<li>Garantizar el correcto funcionamiento de la infraestructura de software y hardware instalado en AVCA.</li>
<li>Capacitar a los responsables de los equipos informáticos en su adecuado manejo.</li>',
                'tabulador_salarial_id' => 24,
                'area_id'               => 5,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Coordinador de proyectos de sistemas',
                'perfil'                => '<h2>COORDINADOR DE PROYECTOS DE SISTEMAS</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Asistir a la Presidencia y demás dependencias en lo referente a la asesoría y acompañamiento en la toma de decisiones que involucren software o hardware.</p>

<h4>EDUCACIÓN:</h4>
<p>Técnico o Tecnólogo o cuatro (4) semestres de carrera profesional en Sistemas, Telecomunicaciones o Informática.</p>

<h4>EXPERIENCIA:</h4>
<p>Dos (2) años en cargos específicos.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Asistir junto con el jefe del Área, a las demás Dependencias de la Empresa en lo referente a sistemas de información, métodos, formatos y procedimientos en general.</li>
<li>Colaborar con el direccionamiento de proyectos que optimicen los sistemas de información y tecnológicos de la Empresa.</li>
<li>Coordinar los estudios técnicos necesarios de conveniencia y factibilidad técnica de las diferentes Dependencias.</li>
<li>Conceptuar sobre la factibilidad con relación a los cambios administrativos, técnicos y renovación de software de la Empresa.</li>',
                'tabulador_salarial_id' => 23,
                'area_id'               => 5,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Técnico de software de Información',
                'perfil'                => '<h2>TÉCNICO SOFTWARE DE INFORMACION</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Consolidar, organizar y verificar los requerimientos técnicos de cada una de las Dependencias para la aprobación definitiva en cuanto a la implementación y nuevos desarrollos de soluciones informáticas en la Empresa.</p>

<h4>EDUCACIÓN:</h4>
<p>Técnico o Tecnólogo o cuatro (4) semestres de carrera profesional en Sistemas o
Telecomunicaciones o Informática. </p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año en cargos específicos.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Controlar y verificar la ejecución del Presupuesto del Área de Telemática, cumpliendo lo establecido en el cronograma para efectuar las compras.</li>
<li>Contribuir con el desarrollo de los estudios técnicos necesarios de conveniencia y factibilidad técnica de las diferentes Dependencias.</li>
<li>Participar en el desarrollo de nuevas políticas que tiendan a mejorar el software y hardware necesario para la optimización de procesos administrativos.</li>
<li>Consolidar, organizar y verificar los requerimientos técnicos de cada una de las Áreas para la implementación de nuevos desarrollos de soluciones informáticas en la Empresa.</li>',
                'tabulador_salarial_id' => 2,
                'area_id'               => 5,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Técnico de apoyo logistico',
                'perfil'                => '<h2>TÉCNICO DE APOYO LOGÍSTICO</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Tramitar correspondencia, tanto interna como externa, utilizando los medios y criterios establecidos.</p>

<h4>EDUCACIÓN:</h4>
<p>Bachiller.</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Organizar, verificar y entregar documentos a los interesados de acuerdo con los procedimientos y requisitos establecidos.</li>
<li>Realizar actividades de apoyo administrativo cuando se requiera en la Dependencia.</li>
<li>Realizar tareas básicas de almacenamiento y archivo de información y documentación, tanto en soporte digital como convencional, de acuerdo con los protocolos establecidos.</li>
<li>Reportar por escrito todo error, peligro y evento no deseado de seguridad operacional de acuerdo a los formatos vigentes.</li>',
                'tabulador_salarial_id' => 4,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Técnico mantenimiento de instalaciones',
                'perfil'                => '<h2>TÉCNICO MANTENIMIENTO DE INSTALACIONES</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Mantener las instalaciones de la Empresa utilizando las técnicas, materiales y herramientas necesarias para asegurar el correcto funcionamiento de dichas estructuras.</p>

<h4>EDUCACIÓN:</h4>
<p>Técnico Industrial o Electricidad o Mantenimiento.</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Cumplir con el programa de mantenimiento asignado en cada una de las áreas de la Empresa.</li>
<li>Efectuar el mantenimiento preventivo a las instalaciones siguiendo el programa de mantenimiento anual.</li>
<li>Conservar actualizado el inventario y en buen estado las herramientas de trabajo.</li>
<li>Realizar las reparaciones a que haya lugar, indicadas por el jefe inmediato.</li>',
                'tabulador_salarial_id' => 2,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Auxiliar de mantenimiento de instalaciones',
                'perfil'                => '<h2>AUXILIAR MANTENIMIENTO DE INSTALACIONES</h2>
<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Mantener las instalaciones de la Empresa utilizando las técnicas, materiales y herramientas necesarias para asegurar el correcto funcionamiento de dichas estructuras.</p>

<h4>EDUCACIÓN:</h4>
<p>Bachiller</p>

<h4>EXPERIENCIA:</h4>
<p>Seis (6) meses de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Cumplir con el programa de mantenimiento asignado en cada una de las áreas de la Empresa.</li>
<li>Efectuar trabajos de carpintería y pintura de acuerdo al programa de mantenimiento anual.</li>
<li>Efectuar el mantenimiento preventivo a las instalaciones siguiendo el programa de mantenimiento anual.</li>
<li>Conservar actualizado el inventario y en buen estado las herramientas de trabajo.</li>',
                'tabulador_salarial_id' => 1,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Conductor',
                'perfil'                => '<h2>CONDUCTOR</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Prestar el servicio de conducción en forma segura, ayudar en el mantenimiento preventivo y buena utilización del parque automotor.</p>

<h4>EDUCACIÓN:</h4>
<p>Bachiller y curso básico de mecánica y electricidad automotriz.</p>
<p>Licencia de conducción requerida para el desarrollo de las actividades de la Empresa.</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Revisar la lubricación, combustible, agua, batería, presión de las llantas, garantizando la adecuada movilización del vehículo.</li>
<li>Reportar las fallas del vehículo asignado en el formato de control.</li>
<li>Cumplir con los turnos asignados.</li>
<li>Cumplir con las reglamentaciones existentes sobre el tráfico en rampa.</li>',
                'tabulador_salarial_id' => 3,
                'area_id'               => 2,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Coordinador de contratos interadministrativos',
                'perfil'                => '<h2>COORDINADOR DE CONTRATO INTERADMINISTRATIVO</h2>
<h4>FUNCION GENERAL DEL CARGO:</h4>
<p>Supervisar y controlar la ejecución contable y de cartera de los contratos interadministrativos suscritos que se encuentran vinculados al contrato de AVCA</p>

<h4>EDUCACIÓN:</h4>
<p>Técnico o Tecnólogo o quinto (5) semestre de carrera profesional en Ingeniería Industrial o Contaduría o Economía o Finanzas y Negocios Internacionales o Administración de Empresas.</p>

<h4>EXPERIENCIA:</h4>
<p>Dos (2) años de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Realizar los Informes de Gestión solicitados por presidencia sobre el manejo de los contratos interadministrativos.</li>
<li>Reportar al Director Financiero el manejo de los contratos interadministrativos.</li>
<li>Supervisar y coordinar el personal de Aviatur que labora en la Dirección Financiera.</li>
<li>Recaudar los ingresos que se generan a causa de los contratos interadministrativos.</li>
<li>Informar al personal encargado del cargue de ventas diarias en AVIATUR las inconsistencias que se presentan con los archivos.</li>',
                'tabulador_salarial_id' => 22,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Analista de ventas presenciales y no presenciales con TDC',
                'perfil'                => '<h2>ANALISTA DE VENTAS PRESENCIALES Y NO PRESENCIALES CON TDC</h2> 

<h4>FUNCION GENERAL DEL CARGO:</h4>
<p>Analizar las operaciones bancarias con tarjetas de crédito.</p>
<h4>EDUCACIÓN:</h4>

<p>Técnico o Tecnólogo o cuatro (4) semestres de carrera profesional en Ingeniería Industrial o Contaduría o Economía o Finanzas y Negocios Internacionales o Administración de Empresas.</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Recopilar, clasificar y Ordenar la información que envían los bancos.</li>
<li>Incorporar en forma periódica la información de bancos al programa manejo tarjetas crédito.</li>
<li>Informar novedades y temas adicionales de tarjetas al outsourcing financiero.</li>
<li>Conciliar a final de mes frente a los extractos e informar al outsourcing financiero y al Área de Crédito y Recaudo.</li>',
                'tabulador_salarial_id' => 1,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Jefe de presupuesto',
                'perfil'                => '<h2>JEFE DE PRESUPUESTO</h2>

<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Planear, organizar, dirigir, analizar y controlar las actividades relacionadas con la ejecución de los ingresos y gastos futuros y presentes de la Empresa.</p>

<h4>EDUCACIÓN:</h4>
<p>Título profesional en Contaduría o Administración de Empresas o Ingeniería Industrial o Economía o Finanzas y Negocios Internacionales.</p>
<p>Especialización en áreas relacionadas a las funciones específicas del cargo o su Equivalencia.</p>
<p>Equivalencia: Título de especialización por tres (3) años de experiencia profesional relacionada, adicional a la requerida por el cargo.</p>

<h4>EXPERIENCIA:</h4>
<p>Tres (3) años de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Proyectar, consolidar y presentar en coordinación con la Oficina de Planeación, el proyecto general de presupuesto de la Empresa a los organismos competentes, para su aprobación.</li>
<li>Administrar, consolidar, presentar y controlar la ejecución de los respectivos informes mensuales inherentes al área de Presupuesto.</li>
<li>Programar y controlar el registro y cancelación de créditos, giros y compromisos financieros internos y externos teniendo en cuenta las políticas y normas legales vigentes.</li>
<li>Mantener un sistema de información que garantice la veracidad y administración de la información acorde a los avances tecnológicos y políticas impartidas por el gobierno nacional, sobre el manejo cambiario, presupuestal y de tesorería.</li>',
                'tabulador_salarial_id' => 24,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Jefe de crédito y recaudo',
                'perfil'                => '<h2>JEFE CRÉDITO Y RECAUDO</h2>
<h4>FUNCIÓN GENERAL DEL CARGO:</h4>
<p>Administrar y controlar las actividades desarrolladas en el área con el fin de dar cumplimiento a los objetivos propuestos y hacer entrega de la información estadística y financiera requerida por la Alta Dirección.</p>

<h4>EDUCACIÓN:</h4>
<p>Título profesional en Contaduría Pública o Administración de Empresas o Economía o Ingeniería Industrial.
Especialización en áreas relacionadas a las funciones específicas del cargo o su Equivalencia.</p>
<p>Equivalencia: Título de especialización por tres (3) años de experiencia profesional relacionada, adicional a la requerida por el cargo.</p>

<h4>EXPERIENCIA:</h4>
<p>Tres (3) años de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Preparar los informes y presentaciones que sean requeridos para la Alta Dirección.</li>
<li>Establecer las fechas de los cierres contables, en las actividades que sean imputables al área.</li>
<li>Supervisar él envió de la información contable y financiera al outsourcing.</li>
<li>Validar la información contable del Área de Crédito y Recaudo.</li>',
                'tabulador_salarial_id' => 24,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Analista y auxiliar de contabilidad',
                'perfil'                => '<h2>ANALISTA Y AUXILIAR DE CONTABILIDAD</h2>

<h4>FUNCION GENERAL DEL CARGO:</h4>
<p>Conciliar, estudiar y analizar las operaciones y registros contables de la Empresa apoyando al Jefe de Contabilidad.</p>

<h4>EDUCACIÓN:</h4>
<p>Técnico o Tecnólogo o cuatro (4) semestres de carrera profesional en Ingeniería Industrial o Contaduría o Economía o Finanzas y Negocios Internacionales o Administración de Empresas.</p>

<h4>EXPERIENCIA:</h4>
<p>Un (1) año de experiencia específica.</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECÍFICAS:</h4>
<li>Analizar los registros contables y sugerir los ajustes correspondientes.</li>
<li>Revisar y depurar las partidas relacionadas con los bancos.</li>
<li>Efectuar conciliaciones bancarias.</li>
<li>Solicitar del outsourcing financiero los diferentes certificados de retenciones.</li>',
                'tabulador_salarial_id' => 17,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'titulo'                => 'Técnico apoyo en asuntos legales',
                'perfil'                => '<h2>TÉCNICO DE APOYO EN ASUNTOS LEGALES</h2>

<h4>FUNCIÓN GENERAL DEL CARGO</h4>
<p>Desarrollar las actividades inherentes a la asesoría jurídica en la contratación del personal y respuesta de las </p><p>solicitudes de carácter legal inherentes para su posterior revisión en caso de ser necesario.</p>

<h4>EDUCACIÓN Y CONOCIMIENTOS</h4>
<p>Mínimo ocho (8) semestres de carrera profesional en Derecho.</p>

<h4>EXPERIENCIA</h4>
<p>Un (1) años en cargos relacionados</p>',
                'funciones'             =>'<h4>FUNCIONES ESPECIFICAS</h4>

<li>Tramitar Derechos de Petición y reclamaciones que sean elevadas al Grupo Gestión del Talento Humano.</li>
<li>Dar respuesta a los Derechos de Petición y radicaciones en temas pensionales y de seguridad social inherentes al Grupo Gestión del Talento Humano.</li>
<li>Proyectar Órdenes Presidenciales referentes a reconocimientos de pensiones e indemnizaciones sustitutivas.</li>
<li>Recopilar y consolidar información para dar respuestas a solicitudes elevadas por la Oficina Asesora Jurídica.</li>',
                'tabulador_salarial_id' => 4,
                'area_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],

        ]);
    }
}
