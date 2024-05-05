<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Show;
use App\Models\Locality;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
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
}
