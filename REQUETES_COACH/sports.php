<?php
include('../BDD/connexion.php');

$sql_sports = "SELECT DISTINCT sport.nom FROM sport 
               JOIN disponibilite ON disponibilite.id_sport = sport.id_sport
               WHERE disponibilite.id_coach = ?";
$stmt_sports = $conn->prepare($sql_sports);
$stmt_sports->bind_param("i", $_SESSION['coach_id']);
$stmt_sports->execute();
$result_sports = $stmt_sports->get_result();
?>
