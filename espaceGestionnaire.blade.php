@extends('sommaireGestionnaire')

@section('contenu2')

<h1>Bienvenue sur votre espace de gestionnaire</h1>

<div class="row justify-content-center align-items-center mx-auto p-2">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Gestion des frais</h5>
        <p class="card-text">Gérez et voir les frais forfaits</p>
        <a href="{{ route('chemin_gestionFrais') }}" class="btn btn-primary" id="gestionFrais">Acceder à la Gestion des Frais</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Gestion des Users</h5>
        <p class="card-text">Gérez les users et voir les users</p>
        <a href="{{ route('chemin_gestionUser') }}" class="btn btn-primary" id="gestionUser">Acceder à la Gestion des Users</a>
      </div>
    </div>
  </div>
</div>

<script>
    // Ajoutez un écouteur d'événements pour chaque carré
    document.getElementById('gestionUser').addEventListener('click', function() {
        // Ajoutez ici le code à exécuter lors du clic sur "Gestion Utilisateur"
        alert('Cliquez sur Gestion Utilisateur');
    });

    document.getElementById('gestionFrais').addEventListener('click', function() {
        // Ajoutez ici le code à exécuter lors du clic sur "Gestion Frais"
        alert('Cliquez sur Gestion Frais');
    });
</script>

@endsection
