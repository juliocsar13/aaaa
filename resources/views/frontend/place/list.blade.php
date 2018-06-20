@extends('frontend.layouts.frontend') 

@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Lugares Visitados</h2><span>Conocé los lugares que te recomendamos escaparte.</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="/">Home</a></li>
						<li>lugares</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		
		


		<div class="col-md-12">

			<!-- Sorting - Filtering Section -->
			<div class="row margin-bottom-25 margin-top-30">

				<div class="col-md-6">
					<!-- Layout Switcher -->
					
				</div>

				<div class="col-md-6">
					<div class="fullwidth-filters">
						
						<!-- Panel Dropdown -->
						{{-- <div class="panel-dropdown wide float-right">
							<a href="#">Lifestyles</a>
							<div class="panel-dropdown-content checkboxes">
								 <!-- traer los lifestyles -->
								<!-- Checkboxes -->
								<div class="row">
									<div class="col-md-6">
										<input id="check-a" type="checkbox" name="check">
										<label for="check-a">Elevator in building</label>

										<input id="check-b" type="checkbox" name="check">
										<label for="check-b">Friendly workspace</label>

										<input id="check-c" type="checkbox" name="check">
										<label for="check-c">Instant Book</label>

										<input id="check-d" type="checkbox" name="check">
										<label for="check-d">Wireless Internet</label>
									</div>	

									<div class="col-md-6">
										<input id="check-e" type="checkbox" name="check" >
										<label for="check-e">Free parking on premises</label>

										<input id="check-f" type="checkbox" name="check" >
										<label for="check-f">Free parking on street</label>

										<input id="check-g" type="checkbox" name="check">
										<label for="check-g">Smoking allowed</label>	

										<input id="check-h" type="checkbox" name="check">
										<label for="check-h">Events</label>
									</div>
								</div>
								
								<!-- Buttons -->
								<div class="panel-buttons">
									<button class="panel-cancel">Cancelar</button>
									<button class="panel-apply">Filtrar</button>
								</div>

							</div>
						</div> --}}
						<!-- Panel Dropdown / End -->

						

						<!-- Sort by -->
						{{-- <div class="sort-by">
							<div class="sort-by-select">
								<select data-placeholder="Seleccionar un Pais" class="chosen-select-no-single">
									<option>Selecciona un pais</option>	
									<option>Highest Rated</option>
									<option>Most Reviewed</option>
									<option>Newest Listings</option>
									<option>Oldest Listings</option>
								</select>
							</div>
						</div> --}}
						<!-- Sort by / End -->

					</div>
				</div>

			</div>
			<!-- Sorting - Filtering Section / End -->


			<div class="row">
                @foreach($cPlaces as $place)
                    <!-- Listing Item -->
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('lugares.show', $place->plac_id) }}" class="listing-item-container compact">
                            <div class="listing-item">
                                @if($place->images->first())
                                    <img src="{{ $place->images->first()->source }}" alt="">
                                @else
                                    <img src="images/listing-item-01.jpg" alt="">
                                @endif
                                <div class="listing-item-content">
                                    <div class="numerical-rating" data-rating="{{ $place->valoration }}"></div><!-- valoracion en numero -->
                                    <h3>{{ $place->name }} </h3>
                                    <span>{{ $place->province }}, {{ App\Place::$country[$place->country] }}</span>
                                </div>
                                
                            </div>
                        </a>
                    </div>
                    <!-- Listing Item / End -->
                @endforeach

				

			</div>

			<!-- Pagination -->
			{{-- <div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<!-- Pagination -->
					<div class="pagination-container margin-top-20 margin-bottom-40">
						<nav class="pagination">
							<ul>
								<li><a href="#" class="current-page">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div> --}}
			<!-- Pagination / End -->

		</div>

	</div>
</div>

<!-- Footer
================================================== -->
<div id="footer" class="margin-top-15">
	<!-- Main -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-6">
				<img class="footer-logo" src="{{ asset('frontend/images/logo.png') }}" alt="">
				<br><br>
				<p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
			</div>

			<div class="col-md-4 col-sm-6 ">
				<h4>Helpful Links</h4>
				<ul class="footer-links">
					<li><a href="#">Login</a></li>
					<li><a href="#">Sign Up</a></li>
					<li><a href="#">My Account</a></li>
					<li><a href="#">Add Listing</a></li>
					<li><a href="#">Pricing</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>

				<ul class="footer-links">
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Our Partners</a></li>
					<li><a href="#">How It Works</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>		

			<div class="col-md-3  col-sm-12">
				<h4>Contact Us</h4>
				<div class="text-widget">
					<span>12345 Little Lonsdale St, Melbourne</span> <br>
					Phone: <span>(123) 123-456 </span><br>
					E-Mail:<span> <a href="#">office@example.com</a> </span><br>
				</div>

				<ul class="social-icons margin-top-20">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
				</ul>

			</div>

		</div>
		
		<!-- Copyright -->
		<div class="row">
			<div class="col-md-12">
				<div class="copyrights">© 2017 Listeo. All Rights Reserved.</div>
			</div>
		</div>

	</div>

</div>
<!-- Footer / End -->


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

@endsection