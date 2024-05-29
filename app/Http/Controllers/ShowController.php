<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use Carbon\Carbon;
use App\Models\Locality;
use App\Models\Artist;
use Illuminate\Support\Facades\App;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //App::setLocale('fr');
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
            //
        ;

        return view('show.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation des données

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
}
