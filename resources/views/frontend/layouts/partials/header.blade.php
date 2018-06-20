<!-- Header Container
================================================== -->
<header id="header-container">

        <!-- Header -->
        <div id="header">
            <div class="container">
                
                <!-- Left Side Content -->
                <div class="left-side">
                    
                    <!-- Logo -->
                    <div id="logo">
                        <a href="{{ route('home.index') }}"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></a>
                    </div>
    
                    <!-- Mobile Navigation -->
                    <div class="mmenu-trigger">
                        <button class="hamburger hamburger--collapse" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
    
    
                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1">
                        <ul id="responsive">
    
                            <li><a  href="#">Start</a>
                                <ul>
                                    <li><a href="nosotros.html"> Escapar.me</a></li>
                                    <li><a href="news.html"> Alertas de Escapadas</a></li>
                                    <li><a href="my-review.html"> Agregar mi Review</a></li>
                                    <hr>
                                    <li><a href="https://www.facebook.com/Escaparme-1726887357407279/" target="_blank">Facebook</a></li>
                                    <li><a href="">Instagram</a></li>
                                    
                                    
                                </ul>
                            </li>
    
                            
    
                            <li><a href="#">Escapar.me </a>
                                <div class="mega-menu mobile-styles three-columns"  >
                                        <!-- estos links lo pongo a mano fer.. , la idea es que permitan tener friendly url tipo escarpar.me/buscador/negocios/bares-en-zona-norte -->
                                        <div class="mega-menu-section">
                                            <ul>
                                                <li class="mega-menu-headline">Lifestyle</li>
                                                @foreach(App\Lifestyle::getLifestyles(5) as $lifestyle)
                                                    <li><a href="javascript:void(0)"><i class="sl sl-icon-pin"></i> {{ $lifestyle->name }}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <!-- estos links lo pongo a mano deigo.. , la idea es que permitan tener friendly url tipo escarpar.me/a/lugares -->
                                        <div class="mega-menu-section">
                                            <ul>
                                                <li class="mega-menu-headline">Paises</li>
                                                @foreach(App\Place::$country as $i => $country)
                                                    <li><a href="javascript:void(0)"><i class="sl sl-icon-directions"></i> {{ $country }}</a></li>
                                                @endforeach
                                                {{-- <li><a href=""><i class="sl sl-icon-directions"></i> Chile</a></li>
                                                <li><a href=""><i class="sl sl-icon-directions"></i> Brasil</a></li>
                                                <li><a href=""><i class="sl sl-icon-directions"></i> Paraguay</a></li>
                                                <li><a href=""><i class="sl sl-icon-directions"></i> Uruguay</a></li> --}}
                                            </ul>
                                        </div>
    
                                        <div class="mega-menu-section">
                                            <ul>
                                                <li class="mega-menu-headline">Escapar.me</li>
                                                <li><a href="join-us.html"><i class="sl sl-icon-settings"></i> Join Us</a></li>
                                                <li><a href="publicidad.html"><i class="sl sl-icon-tag"></i> Publicidad</a></li>
                                                <li><a href="visitarme.html"><i class="sl sl-icon-pencil"></i> Visitar.me</a></li>
                                                <li><a href="contacto.html"><i class="sl sl-icon-diamond"></i> Contacto</a></li>
                                                <li><a href="contacto.html"><i class="sl sl-icon-notebook"></i> Legales</a></li>
                                            </ul>
                                        </div>
                                        
                                </div>
                            </li>
                            
                            <li><a href="#"> Ford </a>
    
                                <div class="mega-menu mobile-styles three-columns">
                                        <!-- estos links lo pongo a mano fer.. , la idea es que permitan tener friendly url tipo escarpar.me/buscador/negocios/bares-en-zona-norte -->
                                        
                                        <div class="mega-menu-section">
                                            
                                            <ul>
                                                <li class="mega-menu-headline">Escapate con Tu Ford</li>
                                                <li><a href="pages-user-profile.html"><i class="sl sl-icon-arrow-right"></i>Nuevo Ford Ka</a></li>
                                                <li><a href="pages-booking.html"><i class="sl sl-icon-arrow-right"></i> Nuevo Ford Fiesta</a></li>
                                                <li><a href="pages-add-listing.html"><i class="sl sl-icon-arrow-right"></i>Nuevo Ford Focus </a></li>
                                                
                                                <li><a href="pages-contact.html"><i class="sl sl-icon-arrow-right"></i> Nuevo Mondeo</a></li>
                                                
                                                <li><a href="pages-masonry-filtering.html"><i class="sl sl-icon-arrow-right"></i> Mustang</a></li>
                                            </ul>
                                        </div>
                                        <!-- estos links lo pongo a mano fer.. , la idea es que permitan tener friendly url tipo escarpar.me/a/lugares -->
                                        <div class="mega-menu-section">
                                            <ul>
                                                <li class="mega-menu-headline">SUV & Ranger</li>
                                                <li><a href="pages-contact.html"><i class="sl sl-icon-arrow-right"></i> Nueva Ecosport</a></li>
                                                <li><a href="pages-coming-soon.html"><i class="sl sl-icon-arrow-right"></i> Nueva Kuga</a></li>
                                                <li><a href="pages-404.html"><i class="sl sl-icon-arrow-right"></i> Nueva S-Max</a></li>
                                                <li><a href="pages-coming-soon.html"><i class="sl sl-icon-arrow-right"></i> Nueva Ranger</a></li>
                                                
                                                
                                            </ul>
                                        </div>
    
                                        <div class="mega-menu-section">
                                            <ul>
                                                <li class="mega-menu-headline">Ford Argentina</li>
                                                <li><a href="join-us.html"><i class="sl sl-icon-arrow-right"></i> Ford.com.ar</a></li>
                                                <li><a href="publicidad.html"><i class="sl sl-icon-arrow-right"></i> Plan Ovalo </a></li>
                                                <li><a href="publicidad.html"><i class="sl sl-icon-arrow-right"></i> Post-Venta </a></li>
                                                
                                            </ul>
                                        </div>
                                        
                                </div>
                            </li>
    
    
                            <!--POR AHORA ESTO NO VA DIEGO --
                            <li><a href="#">Busco un Negocio</a>
                                <div class="mega-menu mobile-styles three-columns">
    
                                        
                                        <div class="mega-menu-section">
                                            <ul>
                                                <li class="mega-menu-headline">Delivery</li>
                                                <li><a href="pages-user-profile.html"><i class="sl sl-icon-directions"></i> Pizzas</a></li>
                                                <li><a href="pages-booking.html"><i class="sl sl-icon-directions"></i> Empanadas</a></li>
                                                <li><a href="pages-add-listing.html"><i class="sl sl-icon-directions"></i> Sushi</a></li>
                                                <li><a href="pages-blog.html"><i class="sl sl-icon-directions"></i> Helados</a></li>
                                            </ul>
                                        </div>
            
                                        <div class="mega-menu-section">
                                            
                                            <ul>
                                                <li class="mega-menu-headline">Gastronomicos</li>
                                                <li><a href="pages-contact.html"><i class="sl sl-icon-directions"></i> Rotiserias</a></li>
                                                <li><a href="pages-coming-soon.html"><i class="sl sl-icon-directions"></i> Parrillas</a></li>
                                                <li><a href="/"><i class="sl sl-icon-directions"></i> Restaurantes</a></li>
                                                <li><a href="/bares"><i class="sl sl-icon-directions"></i> Bares</a></li>
                                            </ul>
                                        </div>
    
                                        <div class="mega-menu-section">
                                            <ul>
                                                <li class="mega-menu-headline">Guia Digital Norte</li>
                                                <li><a href="buscador.html"><i class="sl sl-icon-magnifier"></i> Buscador</a></li>
                                                <li><a href="buscador.html"><i class="sl sl-icon-book-open"></i> Rubros</a></li>
                                                <li><a href="planes.html"><i class="sl sl-icon-tag"></i> Precios</a></li>
                                                <li></li>
                                                <li><a href="help.html"><i class="sl sl-icon-user-follow"></i> Ayuda?</a></li>
                                            </ul>
                                        </div>
                                </div>
                            </li>-->
                            
                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->
                    
                </div>
                <!-- Left Side Content / End -->
    
    
                <!-- Right Side Content / End -->
                <div class="right-side">
                    <div class="header-widget">
                        
                        {{-- <a href="visitar-me.html" class="button border with-icon">Visitar.me <i class="sl sl-icon-plus"></i></a> --}}
                    </div>
                </div>
                <!-- Right Side Content / End -->
    
                
    
            </div>
        </div>
        <!-- Header / End -->
    
    </header>
    <div class="clearfix"></div>
    <!-- Header Container / End -->