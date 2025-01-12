<?php
require '../BDD/connexion.php';

// Récupérer et sécuriser les valeurs provenant de POST
$id_sport = isset($_POST['id_sport']) ? $conn->real_escape_string($_POST['id_sport']) : '';
$id_coach = isset($_POST['id_coach']) ? $conn->real_escape_string($_POST['id_coach']) : '';
$id_lieu = isset($_POST['id_lieu']) ? $conn->real_escape_string($_POST['id_lieu']) : '';

// Récupérer la liste des sports
$sports = [];
$sqlSports = "SELECT id_sport, nom FROM sport";
$resultSports = $conn->query($sqlSports);
if ($resultSports->num_rows > 0) {
    while ($row = $resultSports->fetch_assoc()) {
        $sports[] = $row;
    }
}

// Récupérer les coaches si un sport est sélectionné
$coaches = [];
if (!empty($id_sport)) {
    $sqlCoaches = "
        SELECT DISTINCT C.id_coach, C.nom, C.prenom
        FROM coach AS C
        JOIN disponibilite AS D ON D.id_coach = C.id_coach
        WHERE D.id_sport = $id_sport
    ";

    $resultCoaches = $conn->query($sqlCoaches);
    if ($resultCoaches->num_rows > 0) {
        while ($row = $resultCoaches->fetch_assoc()) {
            $coaches[] = $row;
        }
    }
}

// Récupérer les lieux si un sport et un coach sont sélectionnés
$lieux = [];
if (!empty($id_sport) && !empty($id_coach)) {
    $sqlLieux = "
        SELECT DISTINCT L.id_lieu, L.nom
        FROM lieu AS L
        JOIN disponibilite AS D ON D.id_lieu = L.id_lieu
        WHERE D.id_sport = $id_sport AND D.id_coach = $id_coach
    ";

    $resultLieux = $conn->query($sqlLieux);
    if ($resultLieux->num_rows > 0) {
        while ($row = $resultLieux->fetch_assoc()) {
            $lieux[] = $row;
        }
    }
}

// Récupérer les disponibilités si un sport, un coach et un lieu sont sélectionnés
$disponibilitesParJour = [];
if (!empty($id_sport) && !empty($id_coach) && !empty($id_lieu)) {
    $sqlDisponibilites = "
        SELECT 
            D.id_disponibilite, 
            D.date, 
            TIME_FORMAT(D.heure_debut, '%H:%i') AS heure_debut, 
            TIME_FORMAT(D.heure_fin, '%H:%i') AS heure_fin,
            C.id_coach, 
            C.nom AS nom_coach, 
            C.prenom AS prenom_coach, 
            L.id_lieu, 
            L.nom AS nom_lieu, 
            S.id_sport, 
            S.nom AS nom_sport
        FROM disponibilite AS D
        JOIN coach AS C ON D.id_coach = C.id_coach
        JOIN lieu AS L ON D.id_lieu = L.id_lieu
        JOIN sport AS S ON D.id_sport = S.id_sport
        WHERE D.id_sport = $id_sport 
            AND D.id_coach = $id_coach 
            AND D.id_lieu = $id_lieu
        ORDER BY D.date, D.heure_debut
    ";

    $resultDisponibilites = $conn->query($sqlDisponibilites);
    if ($resultDisponibilites->num_rows > 0) {
        while ($row = $resultDisponibilites->fetch_assoc()) {
            setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'français');
            $jour = strtoupper(strftime("%A %d %B %Y", strtotime($row['date'])));
            if (!isset($disponibilitesParJour[$jour])) {
                $disponibilitesParJour[$jour] = [];
            }
            $disponibilitesParJour[$jour][] = [
                'id_disponibilite' => $row['id_disponibilite'],
                'date' => $row['date'],
                'heure_debut' => $row['heure_debut'],
                'heure_fin' => $row['heure_fin'],
                'id_coach' => $row['id_coach'],
                'nom_coach' => $row['nom_coach'],
                'prenom_coach' => $row['prenom_coach'],
                'id_lieu' => $row['id_lieu'],
                'nom_lieu' => $row['nom_lieu'],
                'id_sport' => $row['id_sport'],
                'nom_sport' => $row['nom_sport'],
            ];
        }
    }
}

?>

