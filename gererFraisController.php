<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
class gererFraisController extends Controller
{

    function saisirFrais(Request $request){
        if( session('visiteur') != null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $anneeMois = MyDate::getAnneeMoisCourant();
            $mois = $anneeMois['mois'];
            if(PdoGsb::estPremierFraisMois($idVisiteur,$mois)){
                 PdoGsb::creeNouvellesLignesFrais($idVisiteur,$mois);
            }
            $lesFrais = PdoGsb::getLesFraisForfait($idVisiteur,$mois);
            $view = view('majFraisForfait')
                    ->with('lesFrais', $lesFrais)
                    ->with('numMois',$anneeMois['numMois'])
                    ->with('erreurs',null)
                    ->with('numAnnee',$anneeMois['numAnnee'])
                    ->with('visiteur',$visiteur)
                    ->with('message',"")
                    ->with ('method',$request->method());
            return $view;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }



    function sauvegarderFrais(Request $request)
    {
        if( session('visiteur')!= null)
        {
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $anneeMois = MyDate::getAnneeMoisCourant();
            $mois = $anneeMois['mois'];
            $lesFrais = $request['lesFrais'];
            $lesLibFrais = $request['lesLibFrais'];
            $nbNumeric = 0;
            foreach($lesFrais as $unFrais)
            {
                if(is_numeric($unFrais))
                    $nbNumeric++;
            }
            $view = view('majFraisForfait')->with('lesFrais', $lesFrais)
                    ->with('numMois',$anneeMois['numMois'])
                    ->with('numAnnee',$anneeMois['numAnnee'])
                    ->with('visiteur',$visiteur)
                    ->with('lesLibFrais',$lesLibFrais)
                    ->with ('method',$request->method());
            if($nbNumeric == 4)
            {
                // AFFICHER LE MONTANT TOTAL SAISIE DANS LA PAGE SAISIE DE MES FICHES DE FRAIS :
                // Recup les montant unitaire dans bdd 
                $ForfaitUnitaire = PdoGsb::getMontantUnitaire();
                // calcul montant total saisie dans input $lesFrais avec nos $ForfaitUnitaire recup depuis la bdd 
                $montantTotal= $lesFrais['ETP']*$ForfaitUnitaire[0] + $lesFrais['KM']*$ForfaitUnitaire[1] + $lesFrais['NUI']*$ForfaitUnitaire[2] + $lesFrais['REP']*$ForfaitUnitaire[3];
                
                // affichage de confirmation + montant total 
                $message = "Votre fiche a été mise à jour, le montant total du mois est :  $montantTotal €"; 

                $erreurs = null;
                PdoGsb::majFraisForfait($idVisiteur,$mois,$lesFrais);
        	}
		    else
            {
                $erreurs[] ="Les valeurs des frais doivent être numériques";
                $message = '';
            }
            return $view->with('erreurs',$erreurs)
                        ->with('message',$message);
        }
        else
        {
            return view('connexion')->with('erreurs',null);
        }
    }
}


