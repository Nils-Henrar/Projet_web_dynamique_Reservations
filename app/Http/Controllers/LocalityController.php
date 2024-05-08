<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locality;
use App\Http\Requests\LocalityRequest;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $localities = Locality::all(); // ou Db::select('select * from localities'); Db::table('localities')->get();

        return view('locality.index', [
            'localities' => $localities,
            'resource' => 'localities'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('locality.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocalityRequest $request)
    {
        $validatedData = $request->validated();

        // Créer une nouvelle localité avec les données validées
        $locality = new Locality;
        $locality->postal_code = $validatedData['postal_code'];
        $locality->locality = $validatedData['locality'];

        $locality->save();  // Enregistrer dans la base de données
        
        // Rediriger après succès avec un message de succès
        return redirect()->route('locality.index')->with('success', 'Localité créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        $locality = Locality::find($id);

        return view('locality.show', [
            'locality' => $locality,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locality = Locality::find($id);

        return view('locality.edit', ['locality' => $locality]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocalityRequest $request, string $id)
    {
        try {
            // Valider les données du formulaire
            $validatedData = $request->validated();

            // Trouver la localité par son ID
            $locality = Locality::findOrFail($id);  // Exception si l'ID n'existe pas
            
            // Mettre à jour les valeurs
            $locality->postal_code = $validatedData['postal_code'];
            $locality->locality = $validatedData['locality'];

            $locality->save();  // Enregistrer les modifications
            
            return redirect()->route('locality.index')->with('success', 'Localité mise à jour avec succès');
        } catch (ValidationException $e) {
            // Si la validation échoue, retourner avec les erreurs et les anciennes valeurs
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $locality = Locality::findOrFail($id);
        
        $locality->delete();

        return redirect()->route('locality.index')->with('success', 'Localité supprimée avec succès');
    }
}
