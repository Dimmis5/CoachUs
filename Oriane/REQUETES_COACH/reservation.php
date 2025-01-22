<?php
include('../BDD/connexion.php');

$sql_dispos = "SELECT * FROM reservation AS R
               JOIN disponibilite AS D ON R.id_disponibilite = D.id_disponibilite
               WHERE R.id_coach = ? AND D.date >= CURDATE()
               ORDER BY D.date, D.heure_debut";
$stmt_dispos = $conn->prepare($sql_dispos);
$stmt_dispos->bind_param("i", $_SESSION['coach_id']);
$stmt_dispos->execute();
$result_dispos = $stmt_dispos->get_result();

?>
