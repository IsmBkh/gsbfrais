<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class protoController extends Controller
{
    function VoirDerniersFrais(){
        if( session('visiteur') != null){
            $visiteur = auth()->user();
            $idVisiteur = $visiteur->id;

            $infosFiches = PdoGsb::GetMontantEngage($visiteur);

        }
    }
}
