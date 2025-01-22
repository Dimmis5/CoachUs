<?php

include('../BDD/connexion.php');

$sql_historique = "SELECT * FROM reservation AS R
                   JOIN disponibilite AS D ON R.id_disponibilite = D.id_disponibilite
                   WHERE id_sportif = ? AND D.date < CURDATE() AND R.note != 0
                   ORDER BY date, heure_debut";


$stmt_historique = $conn->prepare($sql_historique);
$stmt_historique->bind_param("i", $_SESSION['sportif_id']);
$stmt_historique->execute();
$result_historique = $stmt_historique->get_result();

?>