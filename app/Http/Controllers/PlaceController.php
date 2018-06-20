<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Place;

use App\Lifestyle;

use App\PlaceLifestyle;

use App\Image;

class PlaceController extends Controller
{
    private $oPlace, $oLifestyle, $oImage;

    private $pathPlace = '/frontend/img/place/';

    public function __construct()
    {
        $this->oPlace = new Place();

        $this->oLifestyle = new Lifestyle();

        $this->oImage = new Image();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cPlaces = $this
            ->oPlace
            ->getAllPlace();

        return view('backend.place.index', compact('cPlaces'));
    }

    public function list()
    {
        $cPlaces = $this
            ->oPlace
            ->getAllPlace();

        return view('frontend.place.list', compact('cPlaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cPlaces = $this->oPlace
            ->getAllPlace();

        $cLifestyle = $this
            ->oLifestyle
            ->getAllLifestyle();

        return view('backend.place.create', compact('cPlaces', 'cLifestyle'));
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
            'country' => 'required|string',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'latitud' => 'required|string|max:100',
            'longitud' => 'required|string|max:100',
        ]);

        if($validator->passes())
        {
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
                                ->route('lugar.create')
                                ->with('errors', $errors);
                        }

                        $path = $this->pathPlace;

                        $destinationPath = public_path($path);

                        $extension = $image->getClientOriginalExtension();

                        $imageName = $path . '-' . $field . '-' . time() . '.' . $extension;

                        $image->move($destinationPath, $imageName);

                        $image = $imageName;

                        $oImage = Image::create([
                            'source' => $image,
                            'sour_id' => $oPlace->plac_id
                        ]);
                    }
                }
            }

            $oPlace = Place::create($request);

            if(isset($request['lifestyle']))
            {
                $aLifestyle = $request['lifestyle'];

                for ($i = 0; $i < count($aLifestyle); $i++)
                {
                    $oPlaceLifestyle = PlaceLifestyle::create([
                        'plac_id' => $oPlace->plac_id,
                        'life_id' => $aLifestyle[$i],
                    ]);
                }
            }
        }
        else
        {
            return redirect()
                ->route('lugar.create')
                ->with('errors', "Existen errores, intentar nuevamente.");
        }

        return redirect()
            ->route('lugar.create')
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
        $oPlace = $this
            ->oPlace
            ->getPlaceBySlug($slug);

        $cImages = $this
            ->oImage
            ->getAllImagesBySourId($oPlace->plac_id)
            ->get();

        return view('frontend.place.index', compact('oPlace', 'cImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oPlace = $this
            ->oPlace
            ->getPlaceByPlac($id);

        $aPlaceLifestyle = array_keys($oPlace->placeLifestyles->keyBy('life_id')->toArray());

        $cLifestyle = $this
            ->oLifestyle
            ->getAllLifestyle();

        $cImages = $this
            ->oImage
            ->getAllImagesBySourId($id)
            ->get();

        return view('backend.place.edit', compact('oPlace', 'cLifestyle', 'aPlaceLifestyle', 'cImages'));
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
            'country' => 'required|string',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'latitud' => 'required|string|max:100',
            'longitud' => 'required|string|max:100',
        ]);

        if($validator->passes())
        {
            $oPlace = Place::updateOrCreate(['plac_id' => $id], $request);

            if(isset($request['lifestyle']))
            {
                $aLifestyle = $request['lifestyle'];

                if($oPlace->placeLifestyles->count())
                {
                    $oPlace
                        ->placeLifestyles
                        ->map(function ($placeLifestyle) {
                            $placeLifestyle->delete();
                        });
                }

                for ($i = 0; $i < count($aLifestyle); $i++)
                {
                    PlaceLifestyle::create([
                        'plac_id' => $id,
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
                            ->route('lugar.edit', $id)
                            ->with('errors', $errors);
                    }

                    $path = $this->pathPlace;

                    $destinationPath = public_path($path);

                    $extension = $image->getClientOriginalExtension();

                    $imageName = $path . '-' . $field . '-' . time() . '.' . $extension;

                    $image->move($destinationPath, $imageName);

                    $image = $imageName;

                    $oImage = Image::updateOrCreate(['imag_id' => $i], [
                        'source' => $image,
                        'sour_id' => $oPlace->plac_id
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
                            ->route('lugar.edit', $id)
                            ->with('errors', $errors);
                    }

                    $path = $this->pathPlace;

                    $destinationPath = public_path($path);

                    $extension = $image->getClientOriginalExtension();

                    $imageName = $path . '-' . $field . '-' . time() . '.' . $extension;

                    $image->move($destinationPath, $imageName);

                    $image = $imageName;

                    $oImage = Image::create([
                        'source' => $image,
                        'sour_id' => $oPlace->plac_id
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
            ->route('lugar.edit', $id)
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
        try{
            $oPlace = $this
                ->oPlace
                ->getPlaceByCate($id);

            $oPlace->delete();

            return redirect()
                ->route('lugar.index')
                ->with('delete', TRUE);

        }
        catch (Exception $e)
        {
            return "Error, comunicarse con el Administrador - ".$e->getMessage();
        }
    }
}
