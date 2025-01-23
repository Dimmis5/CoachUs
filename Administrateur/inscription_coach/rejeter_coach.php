<?php
session_start();
include ('../BDD/connexion.php');

$id = $_GET['id'];

$stmt = $db->prepare("DELETE FROM inscriptions_coach_en_attente WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Demande d'inscription rejetée.";
} else {
    echo "Erreur lors de la suppression.";
}

$stmt->close();
$db->close();
?>
