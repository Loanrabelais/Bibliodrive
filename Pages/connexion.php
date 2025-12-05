<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Base de Données</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php
   try {
    $dns = 'mysql:host=localhost;dbname=bibliodrive'; // dbname : nom de la base
    $utilisateur = 'root'; // root sur vos postes
    $motDePasse = ''; // pas de mot de passe sur vos postes
    $connexion = new PDO( $dns, $utilisateur, $motDePasse );
  } catch (Exception $e) {
      echo "Connexion à MySQL impossible : ", $e->getMessage();
      die();
  }
  ?>
</body>
</html>