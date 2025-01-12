<?php
include('../BDD/connexion.php');

// Démarrer la session pour récupérer l'ID sportif
session_start();

// Vérifier si l'utilisateur est connecté et si l'ID sportif est dans la session
if (!isset($_SESSION['id_sportif'])) {
    echo "error: utilisateur non authentifié";
    exit();
}

// Récupérer l'ID sportif de la session
$id_sportif = $_SESSION['id_sportif'];

// Vérifier que toutes les données nécessaires sont présentes dans $_POST
if (
    isset($_POST['id_disponibilite'], $_POST['id_sport'], $_POST['id_coach'], $_POST['note'], $_POST['commentaire'], $_POST['id_lieu'])
) {
    $id_disponibilite = $conn->real_escape_string($_POST['id_disponibilite']);
    $id_sport = $conn->real_escape_string($_POST['id_sport']);
    $id_coach = $conn->real_escape_string($_POST['id_coach']);
    $id_lieu = $conn->real_escape_string($_POST['id_lieu']);
    $note = $conn->real_escape_string($_POST['note']);
    $commentaire = $conn->real_escape_string($_POST['commentaire']);

    // Insertion dans la table reservation
    $sql = "INSERT INTO reservation (id_disponibilite, id_sport, id_coach, id_sportif, id_lieu, note, commentaire)
            VALUES ('$id_disponibilite', '$id_sport', '$id_coach', '$id_sportif', '$id_lieu', '$note', '$commentaire')
    ";

    if ($conn->query($sql) === TRUE) {
        // Réponse en texte simple avec un indicateur de succès
        echo "success";
    } else {
        // Réponse en cas d'erreur avec message d'erreur détaillé
        echo "error: " . $conn->error;
    }
} else {
    // Réponse en cas de données manquantes
    echo "error: Données manquantes";
}

$conn->close();
?>
