<?php

include('../BDD/connexion.php');

$sql_reservationsEnAttente = "SELECT C.nom AS coach_nom, C.prenom AS coach_prenom
                FROM reservation R
                JOIN disponibilite D ON R.id_disponibilite = D.id_disponibilite
                JOIN coach C ON D.id_coach = C.id_coach
                WHERE R.id_sportif = ? AND R.note = 0 AND D.date < CURDATE()";
$stmt_reservationsEnAttente = $conn->prepare($sql_reservationsEnAttente);
$stmt_reservationsEnAttente->bind_param("i", $_SESSION['sportif_id']);
$stmt_reservationsEnAttente->execute();
$result_reservationsEnAttente = $stmt_reservationsEnAttente->get_result();
$nbAvisEnAttente = $result_reservationsEnAttente->num_rows;
?>