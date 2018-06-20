<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Place;

use App\Lifestyle;

use App\Review;

class HomeController extends Controller
{
    private $oPlace, $oLifestyle, $oReview;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->oPlace = new Place();

        $this->oLifestyle = new Lifestyle();

        $this->oReview = new Review();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cPlaces = $this
            ->oPlace
            ->getAllPlace();

        $cLifestyles = $this
            ->oLifestyle
            ->getAllLifestyle();

        $cReviews = $this
            ->oReview
            ->getAllReview()
            ->take(10);

        return view('frontend.home', compact('cPlaces', 'cLifestyles', 'cReviews'));
    }
}
