<?php
include('../BDD/connexion.php');

$sql_passees = "SELECT * FROM reservation AS R
               JOIN disponibilite AS D ON R.id_disponibilite = D.id_disponibilite
               WHERE id_sportif = ? AND D.date < CURDATE() AND R.note = 0
               ORDER BY date, heure_debut";
$stmt_passees = $conn->prepare($sql_passees);
$stmt_passees->bind_param("i", $_SESSION['sportif_id']);
$stmt_passees->execute();
$result_passees = $stmt_passees->get_result();

?>

