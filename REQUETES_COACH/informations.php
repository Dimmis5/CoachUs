<?php
include('../BDD/connexion.php');

if (!isset($_SESSION['coach_id'])) {
    header('Location: ../COACH/connexion.php');
    exit();
}

$sql = "SELECT * FROM coach WHERE id_coach = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['coach_id']);
$stmt->execute();
$result = $stmt->get_result();
$coach = $result->fetch_assoc();
?>