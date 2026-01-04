<?php
 try {
  $dns = 'mysql:host=localhost;dbname=bibliodrive'; // dbname : nom de la base
  $utilisateur = 'root'; // root sur le poste
  $motDePasse = ''; // pas de mot de passe sur le poste
  $connexion = new PDO( $dns, $utilisateur, $motDePasse );
} catch (Exception $e) {
    echo "Connexion à MySQL impossible : ", $e->getMessage();
    die();
}
?>