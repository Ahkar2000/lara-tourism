<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Support\Str;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::when(request('search'),function($query){
            $search = request('search');
            $query->where('name','like',"%$search%");
        })
        ->latest('id')->paginate(10)->withQueryString();
        return view('admin.place.index',compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlaceRequest $request)
    {
        $place = new Place();
        $place->name = $request->name;
        $place->save();
        return back()->with('message','Destination Place is added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return response()->json($place);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlaceRequest  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->name = $request->new_name;
        $place->update();
        return back()->with('message','Destination Place is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
