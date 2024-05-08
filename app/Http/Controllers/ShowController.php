<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use Carbon\Carbon;
use App\Models\Locality;
use App\Models\Artist;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $communeId = $request->input('commune');
        $dateOption = $request->input('date_option');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Option de date prédéfinie sélectionnée
        switch ($dateOption) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::today();
                break;
            case 'this_week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            default:
                // Convertir les chaînes de caractères en objets Carbon
                $startDate = $startDate ? Carbon::parse($startDate) : null;
                $endDate = $endDate ? Carbon::parse($endDate) : null;
                break;
        }

        // Filtres
        $showsQuery = Show::byCommune($communeId)
            ->byDateRange($startDate, $endDate);
        if ($keyword) {
            $showsQuery->withKeyword($keyword);
        }

        $shows = $showsQuery->get();

        $localities = Locality::all(); // Récupération de toutes les localités pour le filtre

        return view('show.index', compact('shows', 'communeId', 'localities', 'keyword'));
        //compact permet de passer des variables à la vue de la même manière que le tableau associatif ['shows' => $shows, 'communeId' => $communeId, 'localities' => $localities]
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();

        return view('show.create', ['artists' => $artists]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'artists' => 'array',
            'artists.*' => 'exists:artists,id', 
            'new_artist_firstname' => 'nullable|string|max:255',
            'new_artist_lastname' => 'nullable|string|max:255',
        ]);

        dd($validated);
        // Créer le spectacle avec les données validées
        $show = Show::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // Si des artistes existants ont été sélectionnés, les associer au spectacle
        if (isset($validated['artists'])) {
            $show->artistTypes()->sync($validated['artists']); // Associe les artistes sélectionnés
        }

        // Si des données pour un nouvel artiste ont été fournies, créer l'artiste et l'associer au spectacle
        if (!empty($validated['new_artist_firstname']) && !empty($validated['new_artist_lastname'])) {
            $newArtist = Artist::create([
                'firstname' => $validated['new_artist_firstname'],
                'lastname' => $validated['new_artist_lastname'],
            ]);

            // Associer le nouvel artiste au spectacle
            $show->artistTypes()->attach($newArtist->id);
        }

        // Rediriger avec un message de succès
        return redirect()->route('admin.show')->with('success', 'Spectacle créé avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //


        $show = Show::find($id); // ou Db::select('select * from shows where id = ?', [$id]); Db::table('shows')->where('id', $id)->first();

        //récupérer les artistes du spectacles et les grouper par type

        $collaborateurs = [];

        foreach ($show->artistTypes as $artistType) {
            $collaborateurs[$artistType->type->type][] = $artistType->artist; // on crée un tableau associatif avec le type d'artiste comme clé et un tableau d'artistes comme valeur.
        }

        return view('show.show', [
            'show' => $show,
            'collaborateurs' => $collaborateurs,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $show = Show::with('artistTypes.artist')->findOrFail($id);
        $artists = Artist::all();
        $selectedArtistIds = $show->artistTypes->pluck('artist_id')->toArray();

        return view('show.edit', ['show' => $show, 'artists' => $artists, 'selectedArtistIds' => $selectedArtistIds]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'title' => 'required|string|max:255', // Exemple de validation
            'description' => 'required|string', // Validation pour la description
            'artists' => 'array', // Si vous avez des artistes associés
            'artists.*' => 'exists:artists,id', // Vérifie que chaque artiste existe
        ]);

        // Récupérer le spectacle à mettre à jour
        $show = Show::findOrFail($id); // Trouver le spectacle ou renvoyer une erreur 404

        // Mettre à jour les champs du spectacle avec les données validées
        $show->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // Mettre à jour les relations many-to-many si nécessaire
        if (isset($validated['artists'])) {
            $show->artistTypes()->sync($validated['artists']); // Mettre à jour les artistes associés
        }

        // Rediriger avec un message de succès
        return redirect()->route('admin.show')->with('success', 'Spectacle mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $show = Show::findOrFail($id);
        
        $show->delete();

        return redirect()->route('admin.show')->with('success', 'Représentation supprimée avec succès');
    }
}
