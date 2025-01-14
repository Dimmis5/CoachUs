<?php
if (!isset($_SESSION['sportif_id'])) {
    header('Location: ../SPORTIF/connexion.php');
    exit();
}

include('../BDD/connexion.php');

$sql = "SELECT * FROM sportif WHERE id_sportif = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['sportif_id']);
$stmt->execute();
$result = $stmt->get_result();
$sportif = $result->fetch_assoc();
?>