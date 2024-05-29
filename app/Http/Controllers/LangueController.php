<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class LangueController extends Controller
{
    //
    public function switch(Request $request, $locale)
    {
        // Récupérer la langue à partir du paramètre de la requête
        $locale = $request->input('locale');
       
        // Assurez-vous que le locale est valide avant de changer la langue
        if (in_array($locale, ['en', 'fr'])) {
            App::setLocale($locale);

            session()->put('locale', $locale);
        }
       // dd(App::getLocale());
        // Rediriger l'utilisateur vers la page précédente
        return redirect()->back();
    }
}
