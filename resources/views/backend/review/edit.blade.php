@extends('backend.layouts.backend') 

@section('content')

    <!-- Titlebar -->
		<div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Editar una Review</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Editar una Review</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-12">

                @include('backend.layouts.partials.alerts.status')

                <div id="add-listing">

                    <form action="{{ route('review.update', $oReview['revi_id']) }}" method="POST" enctype="multipart/form-data">
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
                                    <h5>A que lugar Pertenece la Review <i class="tip" data-tip-content="Dale un nombre al lugar. Aparecera así en la review."></i></h5>
                                    <select class="chosen-select" name="plac_id" required>
                                        <option label="blank">Elige un lugar</option>	
                                        @foreach($cPlaces as $place):
                                            <option value={{ $place['plac_id'] }} @if($oReview['plac_id'] == $place['plac_id']): selected @endif>{{ $place['name'] }}</option>
                                        @endforeach
                                        <!-- Traer la opcion o campo de Nombre de Lugar creado en el add-places.html el campo Nombre del Lugar. -->
                                    </select>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>Nombre de la Review o Lugar <i class="tip" data-tip-content="Es el nombre del lugar al que se visito."></i></h5>
                                    <input type="text" placeholder="Nombre del Restaurante, Plaza, Museo... " name="name" value="{{ $oReview['name'] }}" required>
                                </div>
                            </div>

                            <!-- Row -->
                            <div class="row with-forms">

                                <!-- Status -->
                                <div class="col-md-4">
                                    <h5>Categoria</h5>
                                    <select class="chosen-select" name="cate_id" required>
                                        <option label="blank">Que tipo de Lugar es?</option>	
                                        @foreach($cCategories as $category):
                                            <option value="{{ $category['cate_id'] }}" @if($oReview['cate_id'] == $category['cate_id']): selected @endif>{{ $category['name'] }}</option>
                                        @endforeach
                                        <!-- traer las categorias creadas, que son fisicamente, el lugar commo un Restaurante, una pulperia, un museo, etc. Puse muchas porque cuando desplegas, aparece un predictivo que permite encontrar entre varias opciones, la que necesitas...-->
                                    </select>
                                </div>

                                <!-- Type -->
                                <div class="col-md-4">
                                    <h5>Valoracion <i class="tip" data-tip-content="Que te parecio el lugar, de 1 a 5"></i></h5>
                                    
                                    <input type="number" name="valoration" step="0.1" placeholder="Valoración, ingresa entre 1 y 5" value="{{ $oReview['valoration'] }}">
                                </div>

                                <!-- Type -->
                                <div class="col-md-4">
                                    <h5>Calificacion en una Palabra<i class="tip" data-tip-content="Describe en dos palabras, que te parecio el lugar."></i></h5>
                                    <input type="text" placeholder="Ej: Excelente, Volveria de nuevo..." name="calification" value="{{ $oReview['calification'] }}">
                                </div>

                                
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
                                        <input type="text" name="latitud" placeholder="Latitud" value="{{ $oReview['latitud'] }}">
                                    </div>

                                    <!-- Zip-Code -->
                                    <div class="col-md-6">
                                        <h5>Longitud</h5>
                                        <input type="text" name="longitud" placeholder="Longitud" value="{{ $oReview['longitud'] }}">
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
                                        <h5 class=" margin-bottom-10">Los lifestyles tambien van asignados a las reviews. </h5>
                                        <div class="checkboxes in-row margin-bottom-20">

                                            @foreach($cLifestyle as $i => $lifestyle):
                                        
                                                <input id="check-{{ strtolower($i) }}" type="checkbox" name="lifestyle[]" value="{{ $lifestyle['life_id'] }}" @if(in_array($lifestyle['life_id'], $aReviewLifestyle)): checked @endif>
                                                <label for="check-{{ strtolower($i) }}">{{ $lifestyle['name'] }}</label>
                                            @endforeach
                                    
                                        </div>
                                    </div>

                                    <!-- Zip-Code -->
                                    <div class="col-md-12">
                                        <h5>Para que Sirve?</h5>
                                        <small>Los lifestyles tambien van asigandas a las reviews. Generalmente, los lugares y las reviews comparten los mismo lifetyles, pero en los filtros, el uusuario puede filtrar por lifetyle y lugar.</small>
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
                            </div>

                            <!-- Description -->
                            <div class="form">
                                <h5>Describe el lugar.</h5>
                                <textarea class="WYSIWYG" id="summary-ckeditor" name="description" cols="40" rows="3" id="summary" spellcheck="true">{!! $oReview['description'] !!}</textarea>
                            </div>

                            


                            

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