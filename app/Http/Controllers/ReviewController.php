<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Review;

use App\Lifestyle;

use App\Place;

use App\Category;

use App\Image;

use App\ReviewLifestyle;

class ReviewController extends Controller
{
    private $oReview, $oLifestyle, $oPlace, $oCategory, $oImage;

    private $pathReview = '/frontend/img/review/';

    public function __construct()
    {
        $this->oReview = new Review();

        $this->oLifestyle = new Lifestyle();

        $this->oPlace = new Place();

        $this->oCategory = new Category();

        $this->oImage = new Image();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cReviews = $this
            ->oReview
            ->getAllReview();

        return view('backend.review.index', compact('cReviews'));
    }

    public function list(Request $request)
    {
        $pos = strpos(url()->previous(), 'listar-reviews');

        $posFilter = strpos(url()->previous(), 'filtrar-reviews');

        //dd("la cadena listar-reviews no fue encontrada");
        if ($pos === false && ! $posFilter) {
            extract($request->all());
        }
        else if(isset($pos) || isset($posFilter))
        {
            $request = $request->all();

            $slug1 = array_keys($request)[0];

            $slug2 = array_values($request)[0];

            $string = $slug1 . '=' . $slug2;

            $arr = explode("?",url()->previous());

            $arr2 = explode("&", $arr[1]);

            $stringPart = explode("=", $string);

            foreach($arr2 as $i => $value)
            {
                $pos = strpos($value, $stringPart[0]);

                if($pos === false)
                {
                    //dd("no coincide");
                }
                else
                {
                    //dd("coincide" . $i);
                    $arr2[$i] = $string;
                }
            }

            $url = "";

            foreach ($arr2 as $key => $value) 
            {
                $url .= ($key ? '&' : '') . $value;
                
                $val = explode("=", $value);

                $one = $val[0];

                $two = $val[1];

                $$one = $two;
                //$$val[0] = $val[1];

                //dd(get_defined_vars());
            }
        }
        //list($life_id, $plac_id) = array_values($request->all());
        if(! isset($life_id))
        {
            $life_id = "";
        }

        if(! isset($plac_id))
        {
            $plac_id = "";
        }

        if(! isset($coun_id))
        {
            $coun_id = "";
        }
        //dd(get_defined_vars());
        $cReviews = $this
            ->oReview
            ->getReviews($life_id, $plac_id, $coun_id);

        $cCategories = $this
            ->oCategory
            ->getAllCategory();

        $cPlaces = $this
            ->oPlace
            ->getAllPlace();

        $cLifestyles = $this
            ->oLifestyle
            ->getAllLifestyle();

        $placeName = $this
            ->oPlace
            ->getPlaceByPlac($plac_id) ? $this
            ->oPlace
            ->getPlaceByPlac($plac_id) : null;

        $countryName = $coun_id ? $coun_id : null;

        $lifestyleName = $this
            ->oLifestyle
            ->getLifestyleByLife($life_id) ?
            $this->oLifestyle->getLifestyleByLife($life_id) : null;

        if(isset($url))
        {//dd($url);
            return redirect()
                ->route('reviews.filter', $url)
                ->with('cReviews', $cReviews)
                ->with('cCategories', $cCategories)
                ->with('cLifestyles', $cLifestyles)
                ->with('lifestyleName', $lifestyleName)
                ->with('placeName', $placeName)
                ->with('countryName', $countryName)
                ->with('cPlaces', $cPlaces);

            // $x = view('frontend.review.list', compact('cReviews', 'cCategories', 'cLifestyles', 'lifestyleName', 'placeName', 'countryName', 'cPlaces'));
            // dd($x);
        }

        return view('frontend.review.list', compact('cReviews', 'cCategories', 'cLifestyles', 'lifestyleName', 'placeName', 'countryName', 'cPlaces'));
    }

    public function filterReviews(Request $request)
    {
        $pos = strpos(url()->previous(), 'listar-reviews');

        if ($pos === false) {
            //dd("la cadena listar-reviews no fue encontrada");
            extract($request->all());
        }
        else
        {
            $request = $request->all();

            $slug1 = array_keys($request)[0];

            $slug2 = array_values($request)[0];

            $string = $slug1 . '=' . $slug2;

            $arr = explode("?",url()->previous());

            $arr2 = explode("&", $arr[1]);

            $stringPart = explode("=", $string);

            foreach($arr2 as $i => $value)
            {
                $pos = strpos($value, $stringPart[0]);

                if($pos === false)
                {
                    //dd("no coincide");
                }
                else
                {
                    //dd("coincide" . $i);
                    $arr2[$i] = $string;
                }
            }

            $url = "";

            foreach ($arr2 as $key => $value) 
            {
                $url .= ($key ? '&' : '') . $value;
                
                $val = explode("=", $value);

                $one = $val[0];

                $two = $val[1];

                $$one = $two;
                //$$val[0] = $val[1];

                //dd(get_defined_vars());
            }
        }
        //list($life_id, $plac_id) = array_values($request->all());
        if(! isset($life_id))
        {
            $life_id = "";
        }

        if(! isset($plac_id))
        {
            $plac_id = "";
        }

        if(! isset($coun_id))
        {
            $coun_id = "";
        }
        //dd(get_defined_vars());
        $cReviews = $this
            ->oReview
            ->getReviews($life_id, $plac_id, $coun_id);

        $cCategories = $this
            ->oCategory
            ->getAllCategory();

        $cPlaces = $this
            ->oPlace
            ->getAllPlace();

        $cLifestyles = $this
            ->oLifestyle
            ->getAllLifestyle();

        $placeName = $this
            ->oPlace
            ->getPlaceByPlac($plac_id) ? $this
            ->oPlace
            ->getPlaceByPlac($plac_id) : null;

        $countryName = $coun_id ? $coun_id : null;

        $lifestyleName = $this
            ->oLifestyle
            ->getLifestyleByLife($life_id) ?
            $this->oLifestyle->getLifestyleByLife($life_id) : null;
        //dd("filter Reviews");

        return view('frontend.review.list', compact('cReviews', 'cCategories', 'cLifestyles', 'lifestyleName', 'placeName', 'countryName', 'cPlaces'));
    }

    public function remove(Request $request)
    {
        $request = $request->all();

        $string = array_keys($request)[0] . '=' . array_values($request)[0];

        $arr = explode("?",url()->previous());

        $arr2 = explode("&", $arr[1]);

        if(in_array($string, $arr2))
        {
            $index = array_search($string, $arr2);

            $part = explode("=", $arr2[$index]);
            $part = $part[0] . '=';

            $arr2[$index] = $part;
            //unset($arr2[$index]);

            $url = "";
            foreach ($arr2 as $key => $value) {
                $url .= '&' . $value;
            }

            return redirect()
                ->route('reviews.filter', $url);
        }
        else
        {
            dd("no existe");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $cReviews = $this->oReview
            ->getAllReview();

        $cPlaces = $this->oPlace
            ->getAllPlace();

        $cCategories = $this->oCategory
            ->getAllCategory();

        $cLifestyle = $this
            ->oLifestyle
            ->getAllLifestyle();

        return view('backend.review.create', compact('cPlaces', 'cLifestyle', 'cReviews', 'cCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->all();

        $validator = Validator::make($request, [
            'name' => 'required|string|max:100',
            'latitud' => 'required|string|max:100',
            'longitud' => 'required|string|max:100',
            'calification' => 'required|string|max:100',
        ]);

        if($validator->passes())
        {
            foreach(['image'] as $field)
            {
                if(isset($request[$field]))
                {
                    foreach($request[$field] as $image)
                    {
                        $oValidate = Validator::make($request[$field], [
                            $field => 'image|mimes:jpeg,png,jpg|max:2048',
                        ]);
                        
                        if($oValidate->fails())
                        {
                            $errors = $oValidate
                            ->messages()
                            ->messages()[$field];

                            return redirect()
                                ->route('review.create')
                                ->with('errors', $errors);
                        }

                        $path = $this->pathReview;

                        $destinationPath = public_path($path);

                        $extension = $image->getClientOriginalExtension();
                        
                        $imageName = $path . '-' . $field . '-' . time() . '.' . $extension;

                        $image->move($destinationPath, $imageName);

                        $image = $imageName;

                        $oImage = Image::create([
                            'source' => $image,
                            'sour_id' => $oReview->revi_id
                        ]);
                    }
                }
            }

            $oReview = Review::create($request);

            if(isset($request['lifestyle']))
            {
                $aLifestyle = $request['lifestyle'];

                for ($i = 0; $i < count($aLifestyle); $i++) 
                {
                    $oReviewLifestyle = ReviewLifestyle::create([
                        'revi_id' => $oReview->revi_id,
                        'life_id' => $aLifestyle[$i],
                    ]);
                }
            }
        }
        else
        {
            return redirect()
                ->route('review.create')
                ->with('errors', "Existen errores, intentar nuevamente.");
        }

        return redirect()
            ->route('review.create')
            ->with('status', TRUE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $oReview = $this
            ->oReview
            ->getReviewBySlug($slug);

        // if($oReview == null)
        // {
        //     return response()->view('errors.404', [], 404);
        // }

        $cImages = $this
            ->oImage
            ->getAllImagesBySourId($oReview->revi_id)
            ->get();

        return view('frontend.review.index', compact('oReview', 'cImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oReview = $this->oReview
            ->getReviewByRevi($id);

        $cPlaces = $this->oPlace
            ->getAllPlace();

        $aReviewLifestyle = array_keys($oReview->reviewLifestyles->keyBy('life_id')->toArray());

        $cCategories = $this->oCategory
            ->getAllCategory();

        $cLifestyle = $this
            ->oLifestyle
            ->getAllLifestyle();

        $cImages = $this
            ->oImage
            ->getAllImagesBySourId($id)
            ->get();

        return view('backend.review.edit', compact('cPlaces', 'cLifestyle', 'oReview', 'cCategories', 'aReviewLifestyle', 'cImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $request->all();

        $validator = Validator::make($request, [
            'name' => 'required|string|max:100',
            'latitud' => 'required|string|max:100',
            'longitud' => 'required|string|max:100',
            'calification' => 'required|string|max:100',
        ]);

        if($validator->passes())
        {
            $oReview = Review::updateOrCreate(['revi_id' => $id], $request);

            if(isset($request['lifestyle']))
            {
                $aLifestyle = $request['lifestyle'];

                if($oReview->reviewLifestyles->count())
                {
                    $oReview
                        ->reviewLifestyles
                        ->map(function ($reviewLifestyle) {
                            $reviewLifestyle->delete();
                        });
                }

                for ($i = 0; $i < count($aLifestyle); $i++) 
                {
                    ReviewLifestyle::create([
                        'revi_id' => $id,
                        'life_id' => $aLifestyle[$i],
                    ]);
                }
            }

        }

        foreach(['image'] as $field)
        {
            if(isset($request[$field]))
            {
                foreach($request[$field] as $i => $image)
                {
                    $oValidate = Validator::make($request[$field], [
                        $field => 'image|mimes:jpeg,png,jpg|max:2048',
                    ]);

                    if($oValidate->fails())
                    {
                        $errors = $oValidate
                        ->messages()
                        ->messages()[$field];

                        return redirect()
                            ->route('review.edit', $id)
                            ->with('errors', $errors);
                    }

                    $path = $this->pathReview;

                    $destinationPath = public_path($path);

                    $extension = $image->getClientOriginalExtension();
                    
                    $imageName = $path . '-' . $field . '-' . time() . '.' . $extension;

                    $image->move($destinationPath, $imageName);

                    $image = $imageName;

                    $oImage = Image::updateOrCreate(['imag_id' => $i], [
                        'source' => $image,
                        'sour_id' => $oReview->revi_id
                    ]);
                }
            }
        }

        foreach(['image_new'] as $field)
        {
            if(isset($request[$field]))
            {
                foreach($request[$field] as $i => $image)
                {
                    $oValidate = Validator::make($request[$field], [
                        $field => 'image|mimes:jpeg,png,jpg|max:2048',
                    ]);
                    
                    if($oValidate->fails())
                    {
                        $errors = $oValidate
                        ->messages()
                        ->messages()[$field];

                        return redirect()
                            ->route('review.edit', $id)
                            ->with('errors', $errors);
                    }

                    $path = $this->pathReview;

                    $destinationPath = public_path($path);

                    $extension = $image->getClientOriginalExtension();
                    
                    $imageName = $path . '-' . $field . '-' . time() . '.' . $extension;

                    $image->move($destinationPath, $imageName);

                    $image = $imageName;

                    $oImage = Image::create([
                        'source' => $image,
                        'sour_id' => $oReview->revi_id
                    ]);
                }
            }
        }

        foreach(['image_delete'] as $field)
        {
            if(isset($request[$field]))
            {
                foreach($request[$field] as $i => $image)
                {
                    $oImage = $this
                        ->oImage
                        ->getImageByImag($i)
                        ->delete();
                }
            }
        }

        return redirect()
            ->route('review.edit', $id)
            ->with('status', TRUE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
