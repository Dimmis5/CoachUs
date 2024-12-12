<?php

include('connexion.php'); 

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $adresse = trim($_POST['adresse']);
    $adresse_mail = trim($_POST['adresse_mail']);
    $identifiant = trim($_POST['identifiant']);
    $mot_de_passe = trim($_POST['mot_de_passe']);
    $distance_max = trim($_POST['distance_max']);
    
    if (empty($nom)) {
        $erreurs[] = "Le nom est requis.";
    }
    if (empty($prenom)) {
        $erreurs[] = "Le prénom est requis.";
    }
    if (empty($adresse)) {
        $erreurs[] = "L'adresse est requise.";
    }

    if (empty($adresse_mail)) {
        $erreurs[] = "L'adresse mail est requise.";
    }
    if (empty($identifiant)) {
        $erreurs[] = "L'identifiant est requis.";
    }
    if (empty($mot_de_passe)) {
        $erreurs[] = "Le mot de passe est requis.";
    }
    if (empty($distance_max)){
        $erreurs[] = "La distance max est requis.";
    }

    if (empty($erreurs)) {
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO sportif (nom, prenom, adresse, adresse_mail, identifiant, mot_de_passe, distance_max) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssss", $nom, $prenom, $adresse, $adresse_mail, $identifiant, $mot_de_passe_hash, $distance_max);

        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
