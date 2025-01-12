<?php
include('../BDD/connexion.php');

$sql_lieux = "SELECT DISTINCT lieu.nom 
              FROM lieu 
              JOIN disponibilite ON disponibilite.id_lieu = lieu.id_lieu
              WHERE disponibilite.id_coach = ?";
$stmt_lieux = $conn->prepare($sql_lieux);
$stmt_lieux->bind_param("i", $_SESSION['coach_id']);
$stmt_lieux->execute();
$result_lieux = $stmt_lieux->get_result();
?>
