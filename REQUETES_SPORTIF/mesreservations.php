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



$sql_reservations_passees = "SELECT * FROM reservation AS R
                             JOIN disponibilite AS D ON R.id_disponibilite = D.id_disponibilite
                             WHERE id_sportif = ? AND D.date < CURDATE()
                             ORDER BY date, heure_debut";
$stmt_passees = $conn->prepare($sql_reservations_passees);
$stmt_passees->bind_param("i", $id_sportif);
$stmt_passees->execute();
$result_passees = $stmt_passees->get_result();
?>

