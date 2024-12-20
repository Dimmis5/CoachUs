<?php
$host = 'localhost';
$dbname = 'messagerie_coach_sportif';
$username = 'root';  // Votre nom d'utilisateur de base de données
$password = '';  // Votre mot de passe de base de données

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
