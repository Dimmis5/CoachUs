<?php
include('../BDD/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['update_info'])) {
    $id_coach = $_SESSION['coach_id'];
    $date = trim($_POST['date']);
    $heure_debut = trim($_POST['heure_debut']);
    $heure_fin = trim($_POST['heure_fin']);
    $id_lieu = $_POST['id_lieu'];
    $id_sport = $_POST['id_sport'];

    $erreurs = [];
    if (empty($date)) $erreurs[] = "La date est requise.";
    if (empty($heure_debut)) $erreurs[] = "L'heure de début est requise.";
    if (empty($heure_fin)) $erreurs[] = "L'heure de fin est requise.";

    if (empty($erreurs)) {
        $stmt = $conn->prepare("INSERT INTO disponibilite (id_coach, date, heure_debut, heure_fin, id_lieu, id_sport) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssii", $id_coach, $date, $heure_debut, $heure_fin, $id_lieu, $id_sport);
        if ($stmt->execute()) {
            echo "<p>Créneau ajouté avec succès !</p>";
        } else {
            echo "<p>Erreur : " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}
?>
