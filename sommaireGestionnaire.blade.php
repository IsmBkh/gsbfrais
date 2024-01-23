@extends ('modeles/visiteur')
    @section('menu')
            <!-- Division pour le sommaire gestionnaire -->
            <div id="menuGauche">
            <div id="infosUtil">
                  
             </div>  
               <ul id="menuList">
                   <li >
                    <strong>Bonjour {{ $gestionnaire['nom'] . ' ' . $gestionnaire['prenom'] }}</strong>
                  
                  <li class="smenu">
                    <a href="{{ route('chemin_gestionnaire') }}" title="Espace Gestionnaire">Espace Gestionnaire</a>
                  </li>

               <li class="smenu">
                <a href="{{ route('chemin_deconnexion') }}" title="Se déconnecter">Déconnexion</a>
                  </li>
                </ul>
               
        </div>
    @endsection  
            