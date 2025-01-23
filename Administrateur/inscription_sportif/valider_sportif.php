<?php
include('../BDD/connexion.php');

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM inscriptions_en_attente WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $sql_insert = "INSERT INTO sportif (nom, prenom, adresse, numero_de_telephone, adresse_mail, identifiant, mot_de_passe)
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssssss", $row['nom'], $row['prenom'], $row['adresse'], $row['numero_de_telephone'], $row['adresse_mail'], $row['identifiant'], $row['mot_de_passe']);
        $stmt_insert->execute();

        $sql_delete = "DELETE FROM inscriptions_en_attente WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        $stmt_delete->execute();

        header('Location: ../Administrateur/admindashboard.php?success=1');
    } else {
        header('Location: ../Administrateur/admindashboard.php?error=Demande non trouvée');
    }
}
?>
