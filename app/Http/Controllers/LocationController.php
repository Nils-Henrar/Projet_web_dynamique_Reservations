<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Locality;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $locations = Location::all(); // ou Db::select('select * from locations'); Db::table('locations')->get();

        return view('location.index', [
            'locations' => $locations,
            'resource' => 'lieux'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $localities = Locality::all();

        return view('location.create', [
            'localities' => $localities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        // validation des données du formulaire   
        $validated = $request->validated();

        $location = new Location();

        $location->designation = $validated['designation'];
        $location->address = $validated['address'];
        $location->website = $validated['website'];
        $location->phone = $validated['phone'];
        $location->locality_id = $validated['locality_id'];
        $location->slug = str_replace(' ', '-', strtolower($validated['designation']));

        $location->save();

        return redirect()->route('location.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */


        $location = Location::find($id); // ou Db::select('select * from locations where id = ?', [$id]); Db::table('locations')->where('id', $id)->first();

        return view('location.show', [
            'location' => $location,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $location = Location::find($id);
        $localities = Locality::all();

        return view('location.edit', [
            'location' => $location,
            'localities' => $localities
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, $id)
    {
        //validation des données du formulaire
        $validated = $request->validated();

        $location = Location::find($id);
        $location->update($validated);

        return redirect()->route('location.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $location = Location::findOrFail($id);
        
        $location->delete();

        return redirect()->route('location.index')->with('success', 'Représentation supprimée avec succès');
    }
}
