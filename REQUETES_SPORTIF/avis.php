<?php
include('../BDD/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reservation = $_POST['id_reservation'];
    $id_sportif = $_POST['id_sportif'];
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];

    if ($note < 1 || $note > 5) {
        echo "La note doit être entre 1 et 5.";
        exit();
    }

    $sql_avis = "UPDATE reservation 
                 SET note = ?, commentaire = ? 
                 WHERE id_reservation = ? AND id_sportif = ?";
    $stmt_avis = $conn->prepare($sql_avis);
    $stmt_avis->bind_param("isii", $note, $commentaire, $id_reservation, $id_sportif);

    if ($stmt_avis->execute()) {
        echo "Avis ajouté avec succès!";
        header('Location: ../SPORTIF/avis.php');
    } else {
        echo "Erreur lors de l'ajout de l'avis.";
    }
}
?>
