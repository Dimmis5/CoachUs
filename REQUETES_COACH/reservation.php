<?php
include('../BDD/connexion.php');

$sql_reservations = "SELECT * FROM reservation WHERE id_coach = ?";
$stmt_reservations = $conn->prepare($sql_reservations);
$stmt_reservations->bind_param("i", $_SESSION['coach_id']);
$stmt_reservations->execute();
$result_reservations = $stmt_reservations->get_result();
?>
