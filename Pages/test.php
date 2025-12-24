<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="..\js\tarteaucitron.js-1.28.0\tarteaucitron.js"></script>
    <script>
        tarteaucitron.init({
        "privacyUrl": "", /* URL de la page de la politique de vie privée */
        "hashtag": "#tarteaucitron", /* Ouvrir le panneau contenant ce hashtag */
        "cookieName": "tarteaucitron", /* Nom du Cookie */
        "orientation": "middle", /* Position de la bannière (top - bottom) */
        "showAlertSmall": true, /* Voir la bannière réduite en bas à droite */
        "cookieslist": true, /* Voir la liste des cookies */
        "adblocker": false, /* Voir une alerte si un bloqueur de publicités est détecté */
        "AcceptAllCta": true, /* Voir le bouton accepter tout (quand highPrivacy est à true) */
        "highPrivacy": true, /* Désactiver le consentement automatique : OBLIGATOIRE DANS l'UE */
        "handleBrowserDNTRequest": false, /* Si la protection du suivi du navigateur est activée, tout interdire */
        "removeCredit": false, /* Retirer le lien vers tarteaucitron.js */
        "moreInfoLink": true, /* Afficher le lien "voir plus d'infos" */
        "useExternalCss": false, /* Si false, tarteaucitron.css sera chargé */
        "readmoreLink": "/cookiespolicy" /* Lien vers la page "Lire plus" A FAIRE OU PAS  */
        });
        (tarteaucitron.job = tarteaucitron.job || []).push('youtube')
  </script>
</head>

<body>
    <div class="container-fluid">
        <?php require_once('entete.php'); ?>
        <div class="row">
            <div class="col-sm-9">
                <div class="youtube_player" videoID="PJCvmeRILLk" width="560" height="315" theme="light" rel="0" controls="1" showinfo="1" autoplay="0"></div>
                <?php
                    echo 'On affecte 10 à la variable x<BR>';
                    $x = 10;
                    echo 'On ajoute une entree dans le tableau $_SESSION de visibilité super globale <br>';
                    $_SESSION["y"] = 10;
                    echo 'et on la retire';
                    $_SESSION["y"] = null;
                ?>
            </div>
            <?php require_once('formulaire.php'); ?>
        </div>
    </div>
</body>
</html>