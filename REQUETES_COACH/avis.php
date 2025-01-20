<?php

include('../BDD/connexion.php');

$sql_avis = "SELECT * FROM reservation AS R
                   JOIN disponibilite AS D ON R.id_disponibilite = D.id_disponibilite
                   WHERE R.id_coach = ? AND D.date < CURDATE() AND R.note != 0
                   ORDER BY D.date, D.heure_debut";


$stmt_avis = $conn->prepare($sql_avis);
$stmt_avis->bind_param("i", $_SESSION['coach_id']);
$stmt_avis->execute();
$result_avis = $stmt_avis->get_result();

?>