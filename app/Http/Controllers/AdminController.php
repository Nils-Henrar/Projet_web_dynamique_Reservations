<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showArtist(string $id)
    {
        $artist = Artist::find($id);

        return view('admin.showartist', [
            'artist' => $artist
        ]);
    }
}
