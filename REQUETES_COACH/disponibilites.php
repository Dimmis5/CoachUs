<?php
include('../BDD/connexion.php');

$sql_dispos = "SELECT * FROM disponibilite WHERE id_coach = ? ORDER BY date, heure_debut";
$stmt_dispos = $conn->prepare($sql_dispos);
$stmt_dispos->bind_param("i", $_SESSION['coach_id']);
$stmt_dispos->execute();
$result_dispos = $stmt_dispos->get_result();
?>
