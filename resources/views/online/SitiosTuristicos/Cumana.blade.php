@extends('online.template.main2')
@section('title','Detalle Vuelo')

@section('content')

	<main role="main">
      <section class="card text-center">
        <div class="container">
          <p class="titulo">Cumaná - Sucre - Venezuela</p>
          <p class="infor">Cumaná es la capital del estado Sucre, ubicada en la entrada del Golfo de Cariaco, 
          junto a la desembocadura del Río Manzanares. Tiene el honor de ser la primera ciudad 
          del continente americano. Fundada por los españoles en 1521, bajo el mando de Gonzalo 
          de Ocampo fue la ciudad natal de uno de los venezolanos más ilustres, Antonio José de Sucre.
          Actualmente es fuerte candidata para ser nombrada patrimonio de la humanidad por la UNESCO, 
          específicamente su casco histórico. En su momento la ciudad de Cumaná también ha sido conocida
           por ser "La Capital Mundial De La Cultura", "La Atenas venezolana" y hoy día es parte de su 
          patrimonio.</p>
        
        </div>
      </section>
<main id="main">

      <!--==========================
      Destinos Section
    ============================-->
    <section id="portfolio"  class="section-bg" >
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Sitios</li>
              <li data-filter=".filter-app">Históricos</li>
              <li data-filter=".filter-card">Hoteles</li>
              <li data-filter=".filter-web">Locales</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/historicos/casa/ca.jpg') }} " class="img-fluid" alt="Casa Andrés Eloy Blanco">
                <a href="{{ asset('/online/img/portfolio/cumana/historicos/casa/ca.jpg') }}" data-lightbox="portfolio" data-title="Casa Andrés Eloy Blanco" class="link-preview" title="Ver"><i class="ion ion-eye"></i></a>
                 <a href="{{ asset('/online/img/portfolio/cumana/historicos/casa/ca2.jpg') }}" data-lightbox="portfolio" data-title="Casa Andrés Eloy Blanco" class="link-preview" title="Ver"><i class="ion ion-eye"></i></a>
                  <a href="{{ asset('/online/img/portfolio/cumana/historicos/casa/ca3.jpg') }}" data-lightbox="portfolio" data-title="Casa Andrés Eloy Blanco" class="link-preview" title="Ver"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#casa"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="casa" tabindex="-1" role="dialog" aria-labelledby="casa" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">
                        <h5 class="modal-title modtit" id="casa">Casa Andrés Eloy Blanco</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                       <!-- <i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>-->
                        <p>La casa natal del poeta Andrés Eloy Blanco, es patrimonio de la ciudad de Cumaná. Ha sido restaurada, conservando sus características originales. Se ha convertido en Casa de la Cultura y museo de la ciudad, donde destacan entre otras cosas, el cuarto del poeta y el parral de sus versos.</p>
                      </div>

                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i> 0293-431.2895</p>
                        <p class="infmod"><i class="ion-clock">Horario: </i>Lunes a viernes de 8:00 am a 12:00 m y de 2:30 pm a 5:30 pm.</p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>calle Sucre Nº 79, frente a la Plaza Bolívar, muy cerca del palacio de gobierno.</p>

                        </div>
                      <div class="modal-footer">
                        
                        <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Casa Andrés Eloy B.</a></h4>
                <img src="{{ asset('/online/img/icon/ed.svg') }}" height="30px" title="Educativo"><img src="{{ asset('/online/img/icon/rc.svg') }}" height="30px" title="Recreativo">
              </div>
            </div>
          </div>

           <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/locales/lemusic/lm.jpg') }}" class="img-fluid" alt="Le Music Café">
                <a href="{{ asset('/online/img/portfolio/cumana/locales/lemusic/lm.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Le Music Café" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/lemusic/lm4.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Le Music Café - Música en vivo" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/lemusic/lm1.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Le Music Café - Cocteles y Cervezas" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/lemusic/lm3.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Le Music Café - Pizzas y más" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#lemusic"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="lemusic" tabindex="-1" role="dialog" aria-labelledby="lemusic" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">
                        <h5 class="modal-title modtit" id="lemusic">Le Music Café</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>"Le Music Café", ubicado en el Colegio de Ingenieros, Caracterizado por su mixtura de sabores, idiomas y notas musicales brindando la mejor Pizza de la Ciudad y un ambiente con la música que tu quieres escuchar, excelente atención y la gente más calida de Cumaná, ven y compruébalo, disfruta de música en vivo, cocteles y más...</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i>0293-431.6148</p>
                        <p class="infmod"><i class="ion-clock">Horario: De martes a sábado de 06:00pm a 03:00am</i></p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>Av Perimetral, Colegio de Ingenieros</p>

                        </div>
                      <div class="modal-footer">
                        <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Le Music Café</a></h4>
                <img src="{{ asset('online/img/icon/rt.svg') }}" height="30px" alt="" title="Restaurant"> <img src="{{ asset('online/img/icon/noct.svg') }}" height="30px" alt="" title="Nocturno"> <img src="{{ asset('online/img/icon/music.svg') }}" height="30px" title="Música en Vivo"><img src="{{ asset('online/img/icon/wifi.svg') }}" height="30px" title="Zona WiFi"><img src="{{ asset('online/img/icon/car.svg') }}" height="30px" title="Estacionamiento">
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/hoteles/nt/nt.jpg') }}" class="img-fluid" alt="Hotel Nueva Toledo Suites & Hotel">
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/nt/nt1.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Nueva Toledo Suites & Hotel" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/nt/nt2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Nueva Toledo Suites & Hotel" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/nt/nt3.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Nueva Toledo Suites & Hotel" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#hnt"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="hnt" tabindex="-1" role="dialog" aria-labelledby="hnt" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">
                        <h5 class="modal-title modtit" id="hnt">Hotel Nueva Toledo Suites & Hotel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>Es un complejo de hotelería & suites 4 estrellas. Un lugar especial para tu estancia, en el que podrás disfrutar de la cercanía a la playa San Luis, cuenta con una gran piscina para adultos y otra para niños, un parque infantil para los más pequeños de la casa, cancha de tenis, de voleibol, bolas criollas y una mesa de pool, para los amantes del deporte. Dentro de sus instalaciones podrás visitar su tienda y agencia de excursiones. Este hospedaje cuenta también con diversos salones, para todo tipo de eventos (convenciones, cursos, reuniones, bodas), además podrás degustar de sus deliciosos platos en sus 2 restaurantes, y de sus bebidas nacionales e importadas en su bar en piscina o su Lobby Bar. También podrás pasar un buen rato, con familiares y amigos en su tasca, la cual tiene karaoke y tv. El Nueva Toledo Suites & Hotel, te garantiza el disfrute de tu estadía en sus instalaciones.</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i>0293-451.8118</p>
                        <p class="infmod"><i class="ion-clock">Horario: </i>24hrs</p>
                        <p class="infmod"><i class="ion-ios-location">Dirección:</i> Avenida Universidad, sector San Luis</p>

                        </div>
                      <div class="modal-footer">
                        <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Nueva Toledo S&H</a></h4>
                <img src="{{ asset('/online/img/icon/ht.svg') }}" height="30px" title="Hotel"><img src="{{ asset('/online/img/icon/ar.svg') }}" height="30px" title="Áreas recreativas al aire libre"><img src="{{ asset('/online/img/icon/rt.svg') }}" height="30px" title="Restaurant"><img src="{{ asset('/online/img/icon/ct.svg') }}" height="30px" title="Áreas deportivas"><img src="{{ asset('/online/img/icon/mc.svg') }}" height="30px" title="karaoke"><img src="{{ asset('/online/img/icon/noct.svg') }}" height="30px" title="Bar"><img src="{{ asset('/online/img/icon/car.svg') }}" height="30px" title="Estacionamiento">

              </div>
            </div>
          </div>

         
          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/historicos/castillo/c1.jpg') }}" class="img-fluid" alt="">
                <a href="{{ asset('/online/img/portfolio/cumana/historicos/castillo/c1.jpg') }}"  class="link-preview" data-lightbox="portfolio" data-title="Castillo San Antonio de la Eminencia" title="Preview"><i class="ion ion-eye"></i></a>

                <a href="{{ asset('/online/img/portfolio/cumana/historicos/castillo/c4.jpg') }}"  class="link-preview" data-lightbox="portfolio" data-title="Castillo San Antonio de la Eminencia" title="Preview"><i class="ion ion-eye"></i></a>

                <a href="{{ asset('/online/img/portfolio/cumana/historicos/castillo/c5.jpg') }}"  class="link-preview" data-lightbox="portfolio" data-title="Castillo San Antonio de la Eminencia" title="Preview"><i class="ion ion-eye"></i></a>
                 <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#castillo"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="castillo" tabindex="-1" role="dialog" aria-labelledby="castillo" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">
                        <h5 class="modal-title modtit" id="castillo">Castillo San Antonio de la Eminencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>Esta fortaleza militar de la colonia, fue mandada a construir para proteger a los habitantes de las constantes incursiones piratas. Está ubicada en el cerro Pan de Azúcar, desde donde domina la ciudad y a su vez puede observar las azules aguas del Golfo de Cariaco y la península de Araya. Fue la fortificación más importante que protegía a Cumaná, con un diseño de estrella de cuatro puntas, cada una de las cuales apunta a un punto cardinal. Las paredes de este castillo tienen hasta 2 metros de espesor y cuenta con túneles y pasadizos que conecta con la ciudad.</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i>0293-431.0647</p>
                        <p class="infmod"><i class="ion-clock">Horario: </i>De lunes a viernes de 08:00am a 05:00pm</p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>Centro Histórico de la Ciudad</p>

                        </div>
                      <div class="modal-footer">
                        <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Castillo San Antonio</a></h4>
                <img src="{{ asset('/online/img/icon/ed.svg') }}" height="30px" title="Educativo"><img src="{{ asset('/online/img/icon/rc.svg') }}" height="30px" title="Recreativo"><img src="{{ asset('/online/img/icon/ar.svg') }}" height="30px" title="Áreas al aire libre"><img src="{{ asset('/online/img/icon/car.svg') }}" height="30px" title="Estacionamiento">
              </div>
            </div>
          </div>

         <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/locales/mundoc/mc.png') }}" class="img-fluid" alt="Mundo Café Plaza">
                <a href="{{ asset('/online/img/portfolio/cumana/locales/mundoc/mc.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Mundo Café Plaza" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/mundoc/mc2.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Mundo Café Plaza - Variedad en Café" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/mundoc/mc3.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Mundo Café Plaza - Postres Variados" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/mundoc/mc4.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Mundo Café Plaza - Frutas y más" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#mc"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="mc" tabindex="-1" role="dialog" aria-labelledby="mc" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">Mundo Café Plaza</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>Somos Torrefactores Artesanales. Estamos ubicados en el C.C. Marina Plaza, contamos con variedad en deliciosos postres, café, batidos, bol de frutas y todo lo que necesites para deleitar tu paladar, visítanos y comparte en este ambiente familiar con la mejor atención.</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: 0293-451.8765</i></p>
                        <p class="infmod"><i class="ion-clock">Horario: 10:00am a 09:00pm</i></p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>C.C. "Marina Plaza"</p>

                        </div>
                      <div class="modal-footer">
                       <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Mundo Café Plaza</a></h4>
                <img src="{{ asset('/online/img/icon/cf.svg') }}" height="30px" title="Café"><img src="{{ asset('/online/img/icon/hd.svg') }}" height="30px" title="Postres"><img src="{{ asset('/online/img/icon/wifi.svg') }}" height="30px" title="Zona WiFi"><img src="{{ asset('/online/img/icon/car.svg') }}" height="30px" title="Estacionamiento">
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/hoteles/hb/b.jpg') }}" class="img-fluid" alt="Hotel Venetur Cumaná">
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/hb/b1.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Hotel Los Bordones" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/hb/b2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Hotel Los Bordones" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/hb/b3.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Hotel Los Bordones" title="Preview"><i class="ion ion-eye"></i></a>
               <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#hb"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="hb" tabindex="-1" role="dialog" aria-labelledby="hb" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">
                        <h5 class="modal-title modtit" id="hb">Hotel Los Bordones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>Es un imponente hotel 4 estrellas. Cuenta con 111 habitaciones y 3 suites, 2 piscinas, 3 salones para eventos, conferencias y fiestas; con capacidad para 200 personas. También dispone del Restaurante Los Delfines, la Tasca Restaurante El Campanero y un amplio estacionamiento, además de una tienda de variedades y artículos playeros. Se encuentra ubicado en plena Playa San Luis, por lo cual todos los huéspedes cuentan con acceso directo a la Playa. Te ofrece atención personalizada de un equipo de trabajo preparado para atenderte. Tu estancia en las instalaciones te permitirá disfrutar del Caribe a todo placer.</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i>0293-430.8747</p>
                        <p class="infmod"><i class="ion-clock">Horario: </i>24hrs</p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>Av. Universidad, Sector Los Bordones</p>

                        </div>
                      <div class="modal-footer">
                       <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Hotel Los Bordones</a></h4>
                <img src="{{ asset('/online/img/icon/ht.svg') }}" height="30px" title="Hotel"><img src="{{ asset('/online/img/icon/ar.svg') }}" height="30px" title="Áreas recreativas al aire libre"><img src="{{ asset('/online/img/icon/rt.svg') }}" height="30px" title="Restaurant"><img src="{{ asset('/online/img/icon/noct.svg') }}" height="30px" title="Tasca"><img src="{{ asset('/online/img/icon/car.svg') }}" height="30px" title="Estacionamiento">
              </div>
            </div>
          </div>


          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/historicos/museo/mus3.jpg') }}" class="img-fluid" alt="">
                <a href="{{ asset('/online/img/portfolio/cumana/historicos/museo/mus3.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Museo Gran Mariscal de Ayacucho, Cumaná - Estado Sucre" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/historicos/museo/mus2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Museo Gran Mariscal de Ayacucho, Cumaná - Estado Sucre" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/historicos/museo/mus.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Museo Gran Mariscal de Ayacucho, Cumaná - Estado Sucre" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#museo"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="museo" tabindex="-1" role="dialog" aria-labelledby="museo" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">
                        <h5 class="modal-title modtit" id="museo">Museo Gran Mariscal de Ayacucho</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>Esta edificación fue construida en 1945, mantiene una arquitectura espacial funcional propia del estilo neo-colonial, donde las áreas se agrupan alrededor de un patio central con corredores. Allí se exhibe colección de obras iconográficas y de objetos vinculados a la vida y obra del Mariscal Antonio José de Sucre; muestras de bienes pertenecientes a él y su familia, se expone un pendón español de alto Perú en tela de seda bordada con hilos de oro, que data de 1533 y que simboliza el dominio español. Éste fue recibido por el Mariscal Sucre en su departamento de El Cuzco y entregado al Libertador, quien lo remitió al ayuntamiento cumanés. También en la planta baja se encuentra una ofrenda en tela bordada con hilos de oro y plata, realizada en 1890 por el grupo de la Sociedad Mariscal Sucre de Ciudad Bolívar, con motivo de la inauguración de la estatua del héroe en el parque que lleva el mismo nombre. Este museo es especial para visitarlo con los más pequeños, para darle un paseo por la historia del insigne cumanés Antonio José de Sucre.</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i>0293- 432.1896</p>
                        <p class="infmod"><i class="ion-clock">Horario: </i>De lunes a domingo de 08:00am a 05:00pm</p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>Av. Humboldt, en el Parque Ayacucho</p>

                        </div>
                      <div class="modal-footer">
                        <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Museo Gran Mariscal</a></h4>
                <img src="{{ asset('/online/img/icon/ed.svg') }}" height="30px" title="Educativo"><img src="{{ asset('/online/img/icon/rc.svg') }}" height="30px" title="Recreativo">
              </div>
            </div>
          </div>


          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/hoteles/venetur/v.jpg') }}" class="img-fluid" alt="Hotel Venetur Cumaná">
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/venetur/v1.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Complejo Turístico Hotel Venetur Cumaná" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/venetur/v2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Complejo Turístico Hotel Venetur Cumaná" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/hoteles/venetur/v3.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Complejo Turístico Hotel Venetur Cumaná" title="Preview"><i class="ion ion-eye"></i></a>
                 <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#venetur"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="venetur" tabindex="-1" role="dialog" aria-labelledby="venetur" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">
                        <h5 class="modal-title modtit" id="venetur">Hotel Venetur Cumaná</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>Es un complejo hotelero 5 estrellas, son 163 lujosas habitaciones y 39 villas exclusivas. Dispone de 3 piscinas (para niños y adultos), gimnasio y campo de golf, además la infraestructura cuenta con 3 restaurantes que te invitan a disfrutar de la gastronomía venezolana, también dispone de 1 bar en el que podrás deleitarte con la degustación del sushi. Para su evento disponemos de salones de fiestas y salas de reuniones con soporte y asistencia en alquiler de equipos, audiovisuales, mantelería y decoraciones. Además posee los servicios sauna, spa, tienda de suvenir, acceso a internet mediante señal WIFI, cajeros automáticos, banco, helipuerto, servicio de enfermería, vigilancia, servicio de taxis ejecutivos y un amplio estacionamiento.</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i>0293-430.1578</p>
                        <p class="infmod"><i class="ion-clock">Horario: </i>24hrs</p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>Avenida Universidad, Sector San Luis</p>

                        </div>
                      <div class="modal-footer">
                       <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Hotel Venetur Cumaná</a></h4>
                <img src="{{ asset('/online/img/icon/ht.svg') }}" height="30px" title="Hotel"><img src="{{ asset('/online/img/icon/ar.svg') }}" height="30px" title="Áreas recreativas al aire libre"><img src="{{ asset('/online/img/icon/rt.svg') }}" height="30px" title="Restaurant"><img src="{{ asset('/online/img/icon/ct.svg') }}" height="30px" title="Áreas deportivas"><img src="{{ asset('/online/img/icon/car.svg') }}" height="30px" title="Estacionamiento"><img src="{{ asset('/online/img/icon/wifi.svg') }}" height="30px" title="Zona WiFi"><img src="{{ asset('/online/img/icon/cash.svg') }}" height="30px" title="Banco">
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('/online/img/portfolio/cumana/locales/vinob/vb5.pn') }}g" class="img-fluid" alt="Vino Bar">
                <a href="{{ asset('/online/img/portfolio/cumana/locales/vinob/vb.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Vino Bar Restaurant Lounge and Sushi Bar" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/vinob/vb2.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Vino Bar Restaurant Lounge and Sushi Bar" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/vinob/vb3.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Vino Bar Restaurant Lounge and Sushi Bar" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="{{ asset('/online/img/portfolio/cumana/locales/vinob/vb4.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Vino Bar Restaurant Lounge and Sushi Bar" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="Más detalles" type="button" class="btn btn-primary" data-toggle="modal" data-target="#vb"><i class="ion ion-android-open"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="vb" tabindex="-1" role="dialog" aria-labelledby="vb" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header modtit">Vino Bar Restaurant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modbod">
                        <p>Somos referencia gastronómica en la ciudad. Estamos ubicados en el C.C. Marina Plaza, Edificio Dársena. Contamos con un menú variado para toda la familia, desde sushi hasta hamburguesas, batidos y mucho más. Ven y disfruta de este ambiente familiar.</p>
                      </div>
                      <div class="infmod">
                        <p class="infmod">Información de contacto</p>
                        <p class="infmod"><i class="ion-ios-telephone">Teléfono: </i>0293-441.0952</p>
                        <p class="infmod"><i class="ion-clock">Horario: </i>De lunes a domingo de 12:00m a 02:00am</p>
                        <p class="infmod"><i class="ion-ios-location">Dirección: </i>C.C. "Marina Plaza"</p>

                        </div>
                      <div class="modal-footer">
                      <p class="modfoot">Conoce Venezuela con nosotros... Viaja, sueña y disfruta...</p><button type="button" class="btn btn-sm btn-primary btncosto" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Vino Bar Restaurant</a></h4>
                <img src="{{ asset('/online/img/icon/rt.svg') }}" height="30px" alt="" title="Restaurant"> <img src="{{ asset('/online/img/icon/noct.svg') }}" height="30px" alt="" title="Nocturno"> <img src="{{ asset('/online/img/icon/music.svg') }}" height="30px" title="Música en Vivo"><img src="{{ asset('/online/img/icon/wifi.svg') }}" height="30px" title="Zona WiFi"><img src="{{ asset('/online/img/icon/car.svg') }}" height="30px" title="Estacionamiento">
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- #portfolio -->
</main>

@endsection