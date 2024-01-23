<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
class gestionnaireController extends Controller
{
    function espaceGestion()
    {
        if(session('gestionnaire') != null)
        {
            $gestionnaire = session('gestionnaire');
            
            return view('espaceGestionnaire')
                ->with('gestionnaire', $gestionnaire);

        }
    }



    function gestionUser()
    {

    }

    function gestionFrais()
    {
        

    }
}
