<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;

class connexionController extends Controller
{
    function connecter()
    {
        return view('connexion')->with('erreurs',null);
    }


    function valider(Request $request){
        $login = $request['login'];
        $mdp = $request['mdp'];

        // verifier si c'est un visiteur ou un gestionnaire : 
        $visiteur = PdoGsb::getInfosVisiteur($login,$mdp);
        $gestionnaire = PdoGsb::getInfosGestionnaire($login,$mdp);

        if(!is_array($visiteur) && !is_array($gestionnaire)){
            $erreurs[] = "Login ou mot de passe incorrect(s)";
            return view('connexion')->with('erreurs',$erreurs);
        }

        if(is_array($visiteur))
        {
            session(['visiteur' => $visiteur]);
            return view('sommaire')->with('visiteur',session('visiteur'));
        }

        if(is_array($gestionnaire))
        {
            session(['gestionnaire' => $gestionnaire]);
            return view('sommaireGestionnaire')->with('gestionnaire',session('gestionnaire'));
        }
    }
    
    
    
    function deconnecter(){
        session(['visiteur' => null] || session(['gestionnaire' => null]));
        return redirect()->route('chemin_connexion');
    }
       
}
