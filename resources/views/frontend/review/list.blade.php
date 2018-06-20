@extends('frontend.layouts.frontend') 

@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Escapar.me</h2><span>Tenemos estas alternativas para vos. </span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="#">Escapar.me a </a></li>
						<li><a href="buscador">Lista de Escapadas</a></li><!-- traer aca la categoria de tipo de escapada -->
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row">



		<!-- Sidebar filtros: en celulares no se ven.. solo disopnibles para tablets y desktop 
		================================================== -->
		<div class="col-lg-3 col-md-4 hidden-xs hidde-sm padding-right-30">
			<div class="sidebar">

				<!-- Filtros Activos -->
				<div class="widget margin-bottom-40">
					<h3 class="margin-top-0 margin-bottom-30">Review Actual</h3>

					<ul class="listing-details-sidebar">
						@if($placeName)
							<li><a href="{{ route('reviews.remove') }}?plac_id={{ $placeName->plac_id }}">
								<i class="sl sl-icon-close"></i>
								</a> {{ $placeName->name }}
							</li><!-- traer en los filtos activos, lifestyle y ubicacion -->
						@endif
						@if($lifestyleName)
							<li><a href="{{ route('reviews.remove') }}?life_id={{ $lifestyleName->life_id }}"><i class="sl sl-icon-close"></i></a> {{ $lifestyleName->name }}</a></li><!-- ubicacion -->
						@endif
						@if($countryName)
							<li><a href="{{ route('reviews.remove') }}?coun_id={{ $countryName }}"><i class="sl sl-icon-close"></i></a> {{ App\Place::$country[$countryName] }}</a></li><!-- ubicacion -->
						@endif
					</ul>

				</div>

				<!-- Widget -->
				<div class="widget margin-bottom-40">
					<h3 class="margin-top-0 margin-bottom-30">Mejora tu reviews</h3>
					
					<!-- Checkboxes Rubros o categorias -->
						<div class="checkboxes one-in-row margin-bottom-15">
							<h4>Ubicaciones</h4> <!-- Traer aca las provincias que esten cargadas -->
							@foreach(App\Place::$country as $i => $country)
								<a href="{{ route('reviews.list', 'coun_id='.$i) }}">
									<input type="checkbox" name="coun_id[]" @isset($countryName) @if($i == $countryName) checked @endif @endisset>
									<label>{{ $country }} </label>
								</a>
							@endforeach
					
						</div>
					<!-- Checkboxes / End -->


					<!-- Checkboxes Rubros o categorias -->
						<!--<div class="checkboxes one-in-row margin-bottom-15 margin-top-35">
							<h4>Experiencia Ford</h4>
					
							<input id="check-a" type="checkbox" name="check">
							<label for="check-a">Nuevo Ford Ka <strong>(48)</strong></label>

							<input id="check-a" type="checkbox" name="check">
							<label for="check-a">Nuevo Ford Fiesta <strong>(48)</strong></label>

							<input id="check-b" type="checkbox" name="check">
							<label for="check-b">Nuevo Ford Focus</label>

							<input id="check-c" type="checkbox" name="check">
							<label for="check-c">Nueva Ford Ecosport</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Nuevo Ford Kuga</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Nuevo Ford Mondeo</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Nuevo Ford Ranger</label>

							
					
						</div>-->
					<!-- Checkboxes / End -->


					<!-- Checkboxes Rubros o categorias -->
						<div class="checkboxes one-in-row margin-bottom-15 margin-top-35">
							<h4>Lugares</h4>
							@foreach($cPlaces as $i => $place)
								<a href="{{ route('reviews.list', 'plac_id='.$place->plac_id) }}">
									<input type="checkbox" name="plac_id[]" @isset($placeName) @if($place->plac_id == $placeName->plac_id) checked @endif @endisset>
									<label for="check-{{ $place->place_id }}">{{ $place['name'] }} </label>
								</a>
							@endforeach
						</div>
					<!-- Checkboxes / End -->

					<!-- Checkboxes Rubros o categorias -->
						<!--<div class="checkboxes one-in-row margin-bottom-15 margin-top-35">
							<h4>Tipos de Salida</h4>
					
							<input id="check-a" type="checkbox" name="check">
							<label for="check-a">Patios Cerveceros <strong>(48)</strong></label>

							<input id="check-b" type="checkbox" name="check">
							<label for="check-b">Hambugueserias</label>

							<input id="check-c" type="checkbox" name="check">
							<label for="check-c">Bares & Restaurantes</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Pulperias & Tapeos</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Hospedajes</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Cabañas</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Playas</label>

							

							
					
						</div>-->
					<!-- Checkboxes / End -->

					<!-- Checkboxes Rubros o categorias -->
						<div class="checkboxes one-in-row margin-bottom-15 margin-top-35">
							<h4>LifeStyle</h4>
							@foreach($cLifestyles as $i => $lifestyle)
								<a href="{{ route('reviews.list', 'life_id='.$i) }}">
									<input type="checkbox" name="life_id"  @isset($lifestyleName) @if($lifestyle->life_id == $lifestyleName->life_id) checked @endif @endisset>
									<label>{{ $lifestyle['name'] }}</label>	
								</a>
							@endforeach
						</div>
					<!-- Checkboxes / End -->

					


					

				</div>
				<!-- Widget / End -->

			</div>
		</div>
		<!-- Sidebar / End -->

		<div class="col-lg-9 col-md-8 ">

			

			<div class="row">
				@foreach($cReviews as $review)
					<div class="col-lg-12 col-md-12">
						<div class="listing-item-container list-layout">
							<a href="{{ route('reviews.show', $review['slug']) }}" class="listing-item">

								<!-- Image -->
								<div class="listing-item-image">
									@if($review->images->first())
										<img src="{{ $review->images->first()->source }}" alt="">
									@else
										<img src="images/listing-item-01.jpg" alt="">
									@endif

									{{-- @if(isset($review->reviewLifestyles->first()->lifestyle))
										<span class="tag">{{ $review->reviewLifestyles->first()->lifestyle->name }}</span>
									@endif --}}
									<span class="tag">{{ $review->category->name }}</span>
								</div>
								
								<!-- Content -->
								<div class="listing-item-content">
									<div class="listing-badge now-open">Nueva</div>

									<div class="listing-item-inner">
										<h3>{{ $review['name'] }} <i class="verified-icon"></i></h3>
										<span>{{ $review->place->name }}, {{ $review->place->province }}, {{ $review->place->city }}</span>

										<!-- Copete o pre-preview o previa de la review, como un adelanto de la review --> 
										<h5>{!! substr($review['description'], 0, 200) . '...' !!} </h5> 
										<div class="star-rating" data-rating="{{ $review['valoration'] }}">
											<div class="rating-counter">{{ $review['calification'] }}</div>
										</div>
									</div>

									
								</div>
							</a>
						</div>
					</div>
				@endforeach

				

				

			</div>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<!-- Pagination -->
					<div class="pagination-container margin-top-20 margin-bottom-40">
						<nav class="pagination">
							No hay mas resultados para esta busqueda.
						</nav>
					</div>
				</div>
			</div>
			<!-- Pagination / End -->

		</div>


		
	</div>
</div>


@include('frontend.layouts.partials.footer')

@endsection