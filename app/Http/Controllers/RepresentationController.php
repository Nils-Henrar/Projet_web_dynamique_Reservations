<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Representation;
use Carbon\Carbon;
use App\Models\Price;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $representations = Representation::all(); // ou Db::select('select * from representations'); Db::table('representations')->get();

        return view('representation.index', [
            'representations' => $representations,
            'resource' => 'representations'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $representation = Representation::find($id); // ou Db::select('select * from representations where id = ?', [$id]); Db::table('representations')->where('id', $id)->first();
        $date = Carbon::parse($representation->schedule)->format('d/m/Y');
        $time = Carbon::parse($representation->schedule)->format('H:i');

        return view('representation.show', [
            'representation' => $representation,
            'date' => $date,
            'time' => $time,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show the form for booking a representation.
     */
    public function book(string $id)
    {
        //

        $representation = Representation::find($id); // ou Db::select('select * from representations where id = ?', [$id]); Db::table('representations')->where('id', $id)->first();
        $date = Carbon::parse($representation->schedule)->format('d/m/Y');
        $time = Carbon::parse($representation->schedule)->format('H:i');

        $currentPrices = Price::where('end_date', '=', null)->get();


        return view('representation.book', [
            'representation' => $representation,
            'date' => $date,
            'time' => $time,
            'currentPrices' => $currentPrices,
        ]);
    }
}
