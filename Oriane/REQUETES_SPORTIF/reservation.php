<?php
include('../BDD/connexion.php');

// Initialiser un tableau pour les champs manquants
$missing_fields = [];

// Vérifier chaque champ
if (!isset($_POST['id_disponibilite'])) {
    $missing_fields[] = 'id_disponibilite';
}
if (!isset($_POST['id_sport'])) {
    $missing_fields[] = 'id_sport';
}
if (!isset($_POST['id_coach'])) {
    $missing_fields[] = 'id_coach';
}
if (!isset($_POST['id_lieu'])) {
    $missing_fields[] = 'id_lieu';
}
if (!isset($_POST['id_sportif'])) {
    $missing_fields[] = 'id_sportif';
}


if (empty($missing_fields)) {
    $id_disponibilite = $conn->real_escape_string($_POST['id_disponibilite']);
    $id_sport = $conn->real_escape_string($_POST['id_sport']);
    $id_coach = $conn->real_escape_string($_POST['id_coach']);
    $id_lieu = $conn->real_escape_string($_POST['id_lieu']);
    $id_sportif = $conn->real_escape_string($_POST['id_sportif']);

    $sql = "INSERT INTO reservation (id_disponibilite, id_sport, id_coach, id_sportif, id_lieu)
            VALUES ('$id_disponibilite', '$id_sport', '$id_coach', '$id_sportif', '$id_lieu')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}

$conn->close();
?>
