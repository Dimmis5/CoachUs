<?php
include('../BDD/connexion.php');

$sql_dispos = "SELECT * FROM reservation AS R
               JOIN disponibilite AS D ON R.id_disponibilite = D.id_disponibilite
               WHERE id_sportif = ? AND D.date >= CURDATE()
               ORDER BY date, heure_debut";
$stmt_dispos = $conn->prepare($sql_dispos);
$stmt_dispos->bind_param("i", $_SESSION['sportif_id']);
$stmt_dispos->execute();
$result_dispos = $stmt_dispos->get_result();

?>

