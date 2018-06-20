@extends('backend.layouts.backend') 

@section('content')

    <!-- Titlebar -->
		<div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edita un Lugar</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Edita un lugar</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-12">

                @include('backend.layouts.partials.alerts.status')

                <div id="add-listing">

                    <form action="{{ route('lugar.update', $oPlace['plac_id']) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <!-- Section -->
                        <div class="add-listing-section">

                                <!-- Headline -->
                                <div class="add-listing-headline">
                                    <h3><i class="sl sl-icon-doc"></i> Lugar</h3>
                                </div>

                                <!-- Title -->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>Nombre del Lugar <i class="tip" data-tip-content="Dale un nombre al lugar. Aparecera así en la review."></i></h5>
                                        <input class="search-field" type="text" name="name" value="{{ $oPlace['name'] }}" required/>
                                    </div>
                                </div>

                                <!-- Row -->
                                <div class="row with-forms">

                                    <!-- Status -->
                                    <div class="col-md-4">
                                        <h5>País</h5>
                                        <select class="chosen-select-no-single" name="country" required>
                                            <option label="blank">Elige un País</option>	
                                            @foreach(App\Place::$country as $i => $place):
                                                <option value="{{ $i }}" @if($oPlace['country'] == $i) : selected @endif>{{ $place }}</option>
                                            @endforeach
                                            <!-- para agregar paises, por el momento no necesito un abm o scrud, simplemente con copiar la etiqueta option el value, agregaremos los paises que necesitemos. -->
                                        </select>
                                    </div>

                                    <!-- Type -->
                                    <div class="col-md-4">
                                        <h5>Provincia <i class="tip" data-tip-content="A que provincia corresponde el lugar."></i></h5>
                                        <input type="text" placeholder="Ej: Cordoba, Buenos Aires" name="province" value="{{ $oPlace['province'] }}" required>
                                    </div>

                                    <!-- Type -->
                                    <div class="col-md-4">
                                        <h5>Ciudad<i class="tip" data-tip-content="Ciudad a la que hace referencia el lugar"></i></h5>
                                        <input type="text" placeholder="Ej: San Isidro, San Fernando," name="city" value="{{ $oPlace['city'] }}" required>
                                    </div>

                                    <!--IMPORTANTE -- Las opciones de provincia y ciudad, no son select, se iran cargando a medida que se vayan creando lo lugares -->
                                </div>
                                <!-- Row / End -->

                        </div>
                        <!-- Section / End -->

                        <!-- Section -->
                        <div class="add-listing-section margin-top-45">

                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-location"></i> Google Maps</h3>
                            </div>

                            <div class="submit-section">

                                <!-- Row -->
                                <div class="row with-forms">

                                    
                                    <!-- City -->
                                    <div class="col-md-6">
                                        <h5>Latitud</h5>
                                        <input type="text" name="latitud" placeholder="Latitud" value="{{ $oPlace['latitud'] }}" required>
                                    </div>

                                    <!-- Zip-Code -->
                                    <div class="col-md-6">
                                        <h5>Longitud</h5>
                                        <input type="text" name="longitud" placeholder="Longitud" value="{{ $oPlace['longitud'] }}" required>
                                    </div>

                                </div>
                                <!-- Row / End -->
                                <p>Se debera proporcionar los numeros de latitud y longitud para que el lugar se ubique en el mapa.</p>

                            </div>
                        </div>
                        <!-- Section / End -->

                        <!-- Section -->
                        <div class="add-listing-section margin-top-45">

                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-location"></i> Lifestyles</h3>
                            </div>

                            <div class="submit-section">

                                <!-- Row -->
                                <div class="row with-forms">

                                    
                                    <div class="col-md-12">

                                        

                                        <!-- Checkboxes -->
                                        <h5 class=" margin-bottom-10">LifeStyles</h5>
                                        <div class="checkboxes in-row margin-bottom-20">

                                            @foreach($cLifestyle as $i => $lifestyle):
                                    
                                                <input id="check-{{ strtolower($i) }}" type="checkbox" name="lifestyle[]" value="{{ $lifestyle['life_id'] }}" @if(in_array($lifestyle['life_id'], $aPlaceLifestyle)): checked @endif)>
                                                <label for="check-{{ strtolower($i) }}">{{ $lifestyle['name'] }}</label>

                                            @endforeach
                                    
                                        </div>
                                        <!-- Checkboxes / End -->
                                        <!-- Traer en este select, los lifestyles creados en el abm o scrud de add-lifestyles.html -->
                                    </div>

                                    <!-- Zip-Code -->
                                    <div class="col-md-12">
                                        <h5>Para que Sirve?</h5>
                                        <small>Los lifestyles son los estilos de vida que vincularemos con los lugares geograficos que iremos creando. De esta manera, los lifestyles seran los que apareceran en el buscador del Home.</small>
                                    </div>

                                </div>
                                <!-- Row / End -->
                                

                            </div>
                        </div>
                        <!-- Section / End -->


                        <!-- Section -->
                        <div class="add-listing-section margin-top-45">
                            <!-- Headline -->
                            <div class="add-listing-headline" style="display: flex">
                                <h3><i class="sl sl-icon-picture"></i> Galeria de Fotos</h3>
                                <button type="button" style="margin-left: 5px" class="button btn-add-image">Agregar</button>
                            </div>
                            <small>Max: 900px x 600px</small>

                            <!-- Dropzone -->
                            <div class="submit-section-image">
                                {{-- <form action="/file-upload" class="dropzone" ></form> --}}
                                @if($cImages->count()):
                                    @foreach($cImages as $image):
                                        <div class="container-image" style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                                            {{-- <a href="{{ asset($image['source']) }}" target="_blank" style="background-color: #eee; border-radius: 50%; width: 38px; height: 38px; display: flex; justify-content: center; align-items: center">
                                                <i class="list-box-icon sl sl-icon-doc"></i>
                                            </a> --}}
                                            <img width="100" src="{{ asset($image['source']) }}" alt="">
                                            <input type="file" style="width: auto; margin: 0 0 0 10px;" class="image" name="image[{{ $image['imag_id'] }}]">
                                            <button type="button" class="button gray btn-delete-image" style="margin-left: 10px;">Borrar</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="container-image" style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                                        <a href="" target="_blank" style="background-color: #eee; border-radius: 50%; width: 38px; height: 38px; display: flex; justify-content: center; align-items: center">
                                            <i class="list-box-icon sl sl-icon-doc"></i>
                                        </a>
                                        <input type="file" style="width: auto; margin: 0 0 0 10px;" class="image" name="image[]">
                                        <button type="button" class="button gray btn-delete-image" style="margin-left: 10px; visibility: hidden">Borrar</button>
                                    </div>
                                @endif
                                </div>
    
                        </div>
                        <!-- Section / End -->


                        <!-- Section -->
                        <div class="add-listing-section margin-top-45">

                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-docs"></i> Descripcion del Lugar</h3>
                                <small>Debe contener el switch para editar en HTML.</small>
                            </div>

                            <!-- Description -->
                            <div class="form">
                                <h5>Describe el lugar.</h5>
                                <textarea class="WYSIWYG" id="summary-ckeditor" name="description" cols="40" rows="3" id="summary" spellcheck="true">{!! $oPlace['description'] !!}</textarea>
                            </div>

                            <!-- Row -->
                            <div class="row with-forms">

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <h5>Valoracion</span></h5>
                                    <input type="number" name="valoration" step="0.1" placeholder="Valoración, ingresa entre 1 y 5" value="{{ $oPlace['valoration'] }}">
                                    {{-- <select class="chosen-select-no-single" name="valoration" required >
                                        <option label="blank">Valor del Lugar</option>
                                        @foreach(App\Place::$validation as $i => $validation):
                                            <option value="{{ ++$i }}">{{ $validation }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>

                                <!-- Website -->
                                <div class="col-md-6">
                                    <h5>Calificacion en una Palabra</span></h5>
                                    <input type="text" name="calification" placeholder="Calificación" value="{{ $oPlace['calification'] }}" required>
                                </div>

                                

                            </div>
                            <!-- Row / End -->


                            

                        </div>
                        <!-- Section / End -->


                        
                        <button class="button preview">Guardar y Publicar <i class="fa fa-arrow-circle-right"></i></button>

                    </form>

                </div>
            </div>

            <!-- Copyrights -->
            <div class="col-md-12">
                <div class="copyrights">© 2018 Escapar.me. </div>
            </div>

        </div>

@endsection

@section('js')

    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
            CKEDITOR.replace( 'summary-ckeditor' );
    </script>
    <script>
            $('.container-image:first-child').find('button').css('visibility', 'hidden');
    
            $('.btn-add-image').on('click', function () {
                var $submit_section = $('.submit-section-image'),
                    $container_image = $submit_section.find('.container-image'),
                    $first = $submit_section.find('.container-image:first-child');
    
                $first
                    .clone(true)
                    .appendTo($submit_section)
                    .find('.image')
                    .val("")
                    .attr("name", "image_new[]")
                    .parent()
                    .find('img')
                    .css('visibility', 'hidden')
                    .parent()
                    .find('button')
                    .css('visibility', 'visible');
                    //.siblings()
                    //.css('visibility', 'visible');
    
                
            })
    
            $(".submit-section-image").on('click', ".container-image .btn-delete-image", function(){
                var $this = $(this);
    
                if(confirm("¿Quieres eliminar la imagen?"))
                {
                    let $container_image = $this
                        .parent('.container-image');
    
                    let $input_image = $container_image
                        .find('.image');
    
                        console.log($input_image
                        .attr('name')
                        .match(/\d/g));
    
                    let revi_id = $input_image
                        .attr('name')
                        .match(/\d/g);
    
                    if(revi_id === null)
                    {
                        $container_image.remove();
    
                        return false;
                    }
    
                    let value = revi_id
                        .join('');
    
                    $input_image
                        .attr('name', `image_delete[${value}]`);
    
                    $container_image
                        .find('a, button, img').css('display', 'none');
    
                    $input_image.attr('type', 'hidden');
                }
            })
        </script>

@endsection