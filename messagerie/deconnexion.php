<?php
session_start();
session_destroy();  // Détruire la session pour déconnecter l'utilisateur
header('Location: connexion.php');  // Rediriger vers la page de connexion
exit;
?>
