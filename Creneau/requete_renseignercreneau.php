<?php

include('../BDD/connexion.php');

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_coach = trim($_POST['id_coach']);
    $date = trim($_POST['date']);
    $heure_debut = trim($_POST['heure_debut']);
    $heure_fin = trim($_POST['heure_fin']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id_lieu'])) {
            $id_lieu = $_POST['id_lieu'];
    
            echo "Vous avez sélectionné le lieu avec l'ID : " . htmlspecialchars($id_lieu);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id_sport'])) {
            $id_sport = $_POST['id_sport'];
    
            echo "Vous avez sélectionné le sport avec l'ID : " . htmlspecialchars($id_sport);
        }
    }
    
    if (empty($id_coach)) {
        $erreurs[] = "L'id_coch'est requis.";
    }
    if (empty($date)) {
        $erreurs[] = "La date est requise.";
    }
    if (empty($heure_debut)) {
        $erreurs[] = "L'heure de début est requise.";
    }
    if (empty($heure_fin)) {
        $erreurs[] = "L'heure de fin est requise.";
    }

    if (empty($erreurs)) {

        $stmt = $conn->prepare("INSERT INTO disponibilite (id_coach,date,heure_debut,heure_fin,id_lieu,id_sport) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("isssii", $id_coach, $date, $heure_debut, $heure_fin, $id_lieu, $id_sport);

        if ($stmt->execute()) {
            echo "Ajout réussi !";
        } else {
            echo "Erreur lors de l'ajout: " . $stmt->error;
        }

        
        $stmt->close();
    }
}

$conn->close();
?>
