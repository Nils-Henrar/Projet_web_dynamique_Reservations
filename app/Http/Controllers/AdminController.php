<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Show;
use App\Models\Locality;
use App\Models\Representation;
use App\Models\Reservation;
use App\Models\Location;
use App\Models\User;
use App\Models\Review;

class AdminController extends Controller
{
    public function dashboard()
    {   
        $artists = Artist::all();
        $shows = Show::all();
        $representations = Representation::all();
        $reservations = Reservation::all();
        $locations = Location::all();
        $localities = Locality::all();
        $users = User::all();
        $reviews = Review::all();

        return view('admin.dashboard', [
            'artists' => $artists,
            'shows' => $shows,
            'representations' => $representations,
            'reservations' => $reservations,
            'locations' => $locations,
            'localities' => $localities,
            'users' => $users,
            'reviews' => $reviews,
        ]);
    }

    public function showArtist(string $id)
    {
        $artist = Artist::find($id);

        return view('admin.artist', [
            'artist' => $artist
        ]);
    }

    public function getShow()
    {   
        $shows = Show::all();

        return view('admin.show', [
            'shows' => $shows
        ]);
    }

    public function getShowId($id)
    {   
        $show = Show::find($id);

        return view('admin.showid', [
            'show' => $show
        ]);
    }

    public function getReservation()
    {   
        $reservations = Reservation::all();

        return view('admin.reservation', ['reservations' => $reservations]);
    }

    public function deleteReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        
        return view('admin.reservation')->with('success', 'La réservation a été suprimé avec succès');
    }

    public function getReview()
    {
        // $reviews = Review::all();
        $reviews = Review::with(['user', 'show'])->get();
        
        return view('admin.review', ['reviews' => $reviews]);
    }

    public function validatedReview($id)
    {
        $review = Review::find($id);
        $review->validated = 1;
        $review->save();
        
        return redirect()->back()->with('success', 'Validé avec succès');
    }

    public function unvalidatedReview($id)
    {
        $review = Review::find($id);
        $review->validated = 0;
        $review->save();
        
        return redirect()->back()->with('success', 'Dévalidé avec succès');
    }
}
