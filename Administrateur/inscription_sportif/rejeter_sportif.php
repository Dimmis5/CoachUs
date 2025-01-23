<?php
include('../BDD/connexion.php');

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM inscriptions_en_attente WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: admin_dashboard.php?success=1');
}
?>
