<?php

include('../BDD/connexion.php');

if (!$connexion) {
    die("Connexion échouée: " . mysqli_connect_error());
}


$query = "SELECT * FROM sportif"; 
$stmt = $connexion->prepare($query); 

if ($stmt === false) {
    die("Erreur de préparation de la requête");
}

$stmt->execute();


$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (count($resultats) > 0) {
    foreach ($resultats as $resultat) {
        echo "Nom : " . $resultat['nom'] . "<br>";
        echo "Prénom : " . $resultat['prenom'] . "<br>";
    }
} else {
    echo "Aucun sportif trouvé.";
}

$stmt->close(); // Fermer la requête
?>
