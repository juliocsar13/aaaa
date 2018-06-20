@extends('backend.layouts.backend') 

@section('content')

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Lugares Escapar.me</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dash</a></li>
                        <li>Lugares</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        
        <!-- Listings -->
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4>Lista de Lugares Creados<br><small>Los lugares creados, son aquellos donde las reviews deberan ser asigandas, es decir, que sin un lugar creado, una review no puede ser guardada.</small></h4>
                
                <ul>
                    @foreach($cPlaces as $place)
                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img"><a href="#"><img src="{{ asset('backend/images/listing-item-02.jpg') }}" alt=""></a></div><!-- Traer primera foto de las 10 que se cargan en la galeria -->
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{ $place['name'] }}</h3><!-- Nombre del Lugar -->
                                        <span>{{ $place['province'] . ', ' . App\Place::$country[$place['country']] }}</span><!-- Traer Provicina y Pais -->
                                        <div class="star-rating" data-rating="{{ $place['valoration'] }}"><!-- Puntate del Lugar -->
                                            <div class="rating-counter"> {{ $place['calification'] }}</div><!-- Calificacion en palabra -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right" style="display: flex">
                                <form class="frm-delete-place" action="{{ route('lugar.destroy', $place['plac_id']) }}" method="post">
                                    <input class="button gray" name="_method" type="hidden" value="DELETE">
                                    <button class="button gray">Borrar</button>
                                    {{ csrf_field() }}
                                </form>
                                <a href="{{ route('lugar.edit', $place['plac_id']) }}" class="button gray"><i class="sl sl-icon-close"></i> Editar</a><!-- Editar el contenido -->
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

@section('js')
    <script>
        $('.frm-delete-place').on('submit', function (e) {
            e.preventDefault();
            let $this = $(this);

            if(confirm("¿Estas seguro de eliminar el lugar?"))
            {
                $this.unbind('submit').submit();
            }   
        });
    </script>
@endsection