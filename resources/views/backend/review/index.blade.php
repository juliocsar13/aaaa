@extends('backend.layouts.backend') 

@section('content')
    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Reviews Creadas</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dash</a></li>
                        <li>Reviews</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        
        <!-- Listings -->
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4>Lista de Reviews Creadas</h4>
                <ul>

                    @foreach($cReviews as $review)
                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img">
                                    <a href="#">
                                        @if($review->images->first()):
                                            <img width="150" src="{{ asset($review->images->first()->source) }}" alt="">
                                        @else
                                            <img src="{{ asset('backend/images/listing-item-02.jpg') }}" alt="">
                                        @endif
                                    </a>
                                </div><!-- Traer primera foto de las 10 que se cargan en la galeria -->
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{ $review['name'] }}</h3><!-- Nombre del Lugar -->
                                        <span>direccion</span><!-- Traer Provicina y Pais -->
                                        <div class="star-rating" data-rating="{{ $review['valoration'] }}"><!-- Puntate del Lugar -->
                                            <div class="rating-counter"> {{ $review['calification'] }}</div><!-- Calificacion en palabra -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="#" class="button gray"><i class="sl sl-icon-close"></i> Borrar</a><!-- Borrar de la base -->
                                <a href="{{ route('review.edit', $review['revi_id']) }}" class="button gray"><i class="sl sl-icon-close"></i> Editar</a><!-- Editar el contenido -->
                                {{-- <a href="#" class="button gray"><i class="sl sl-icon-close"></i> Ocultar</a><!-- Ocultar o Mostrar el contenido // La palabra Ocultar, debe cambiar a Mostrar dependiendo del valor en la base, siendo el estado 1 para que este visible y 0 para que este oculto. De esta manera, no perdemos la informmacion --> --}}
                            </div>
                        </li>
                    @endforeach

                    
                <!-- No tiene paginador, los resultados deben listarse en modo infinito a medida que se va scrolleando para abajo -->
                </ul>
            </div>
        </div>


        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">© 2018 Escapar.me. </div>
        </div>
    </div>
@endsection