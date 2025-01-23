<?php
session_start();
include('../BDD/connexion.php');

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM inscriptions_coach_en_attente WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $coach = $result->fetch_assoc();

    $stmt = $conn->prepare("INSERT INTO coach (nom, prenom, adresse, numero_de_telephone, adresse_mail, identifiant, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssss",
        $coach['nom'],
        $coach['prenom'],
        $coach['adresse'],
        $coach['numero_de_telephone'],
        $coach['adresse_mail'],
        $coach['identifiant'],
        $coach['mot_de_passe']
    );
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM inscriptions_coach_en_attente WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Coach validé avec succès.";
} else {
    echo "Coach introuvable.";
}

$conn->close();
?>
