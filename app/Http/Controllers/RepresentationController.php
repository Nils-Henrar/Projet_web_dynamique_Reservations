<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Representation;
use Carbon\Carbon;
use App\Models\Price;
use App\Models\Show;
use App\Models\Location;

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
        $shows = Show::all();
        $locations = Location::all();

        return view('representation.create', ['shows' => $shows, 'locations' => $locations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Valider les données du formulaire
         $validatedData = $request->validate([
            'show_id' => 'required|exists:shows,id',  // L'ID du spectacle doit exister
            'location_id' => 'nullable|exists:locations,id',  // L'ID du lieu peut être nul, mais doit exister s'il est fourni
            'schedule' => 'nullable|date',  // 'when' doit être une date valide
        ]);

        // Créer une nouvelle représentation
        $representation = new Representation;
        $representation->show_id = $validatedData['show_id'];
        $representation->location_id = $validatedData['location_id'] ?? null;
        $representation->schedule = $validatedData['schedule'] ?? null;
        
        $representation->save();  // Enregistrer dans la base de données
        
        // Redirection après succès avec un message flash
        return redirect()->route('representation.index')->with('success', 'Représentation créée avec succès');
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
        // Charger la représentation par son identifiant
        $representation = Representation::with(['show', 'location'])->findOrFail($id);

        // Charger les données nécessaires pour le formulaire
        $shows = Show::all();  // Tous les spectacles disponibles
        $locations = Location::all();  // Tous les lieux disponibles

        // Retourner la vue d'édition avec les données nécessaires
        return view('representation.edit', ['representation' => $representation, 'shows' => $shows, 'locations' => $locations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'show_id' => 'required|exists:shows,id',
                'location_id' => 'nullable|exists:locations,id',
                'schedule' => 'nullable|date',
            ]);

            $representation = Representation::findOrFail($id);
            $representation->show_id = $validatedData['show_id'];
            $representation->location_id = $validatedData['location_id'] ?? null;
            $representation->schedule = $validatedData['schedule'] ?? null;

            $representation->save();

            return redirect()->route('representation.index')->with('success', 'Représentation mise à jour avec succès');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();  // Renvoie les anciennes valeurs
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $representation = Representation::findOrFail($id);
        
        $representation->delete();

        return redirect()->route('representation.index')->with('success', 'Représentation supprimée avec succès');

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
