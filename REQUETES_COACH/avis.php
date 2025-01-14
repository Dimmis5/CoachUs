<?php
include('../BDD/connexion.php');

$sql_avis = "SELECT * FROM reservation WHERE id_coach = ?";
$stmt_avis = $conn->prepare($sql_avis);
$stmt_avis->bind_param("i", $_SESSION['coach_id']);
$stmt_avis->execute();
$result_avis = $stmt_avis->get_result();
?>
