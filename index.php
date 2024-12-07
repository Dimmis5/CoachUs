<?php

ini_set('display_errors', 1);

include("modeles/connexion.php");
include("modeles/inscriptioncoach.php");
include("vues/inscription_coach.php");

if(isset($_GET['cible']) && !empty($_GET['cible'])) {
    $url = $_GET['cible'];
    
} else {
    $url = 'coach';
}


