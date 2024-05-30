<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ShowResource;
use App\Http\Resources\RepresentationResource;
use App\Http\Resources\ReviewResource;
use App\Models\Show;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // afficher la liste des spectacles

        return ShowResource::collection(Show::limit(10)->with('location')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  ajouter un spectacle

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'auteurs' => 'required|string',
            'poster_url' => 'required|string',
            'duration' => 'required|integer',
            'location_id' => 'required|integer',
            'created_in' => 'required|date',
        ]);

        Show::create($validated);

        return response()->json(['message' => 'Show created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // afficher un spectacle

        $show = Show::find($id);

        return new ShowResource($show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // modifier un spectacle

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'auteurs' => 'required|string',
            'poster_url' => 'required|string',
            'duration' => 'required|integer',
            'location_id' => 'required|integer',
            'created_in' => 'required|date',
        ]);

        $show = Show::find($id);
        $show->update($validated);

        return response()->json(['message' => 'Show updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     * Route::delete('/shows/{id}/reviews/{reviewId}', [\App\Http\Controllers\Api\ShowController::class, 'destroy']);
     */
    public function destroy(string $id)
    {
        //

        $show = Show::find($id);

        if ($show) {
            $show->delete();
            return response()->json(['message' => 'Show deleted successfully']);
        }
    }

    public function representation(string $id)
    {
        // afficher les représentations d'un spectacle

        $show = Show::find($id);
        return RepresentationResource::collection($show->representations);
    }

    public function reviews(string $id)
    {
        // afficher les reviews d'un spectacle

        $show = Show::find($id);
        return ReviewResource::collection($show->reviews);
    }

    public function bestRated()
    {
        // Récupérer les spectacles avec une moyenne des étoiles directement
        $shows = Show::select('shows.title', DB::raw('AVG(reviews.stars) as average_stars'))
            ->join('reviews', 'shows.id', '=', 'reviews.show_id')
            ->groupBy('shows.title')
            ->having('average_stars', '>', 0)
            ->orderBy('average_stars', 'desc')
            ->get();

        return response()->json($shows);
    }



    public function storeReview(Request $request, string $id)
    {
        // Ajouter un commentaire à un spectacle

        $validated = $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $show = Show::find($id);
        $show->reviews()->create($validated);

        return response()->json(['message' => 'Review added successfully']);
    }
}
