<?php
if (!isset($_SESSION['sportif_id'])) {
    header('Location: ../SPORTIF/connexion.php');
    exit();
}

include('../BDD/connexion.php');

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $adresse_mail = trim($_POST['adresse_mail']);
    $adresse = trim($_POST['adresse']);
    $numero_de_telephone = trim($_POST['numero_de_telephone']);

    if (empty($prenom)) {
        $erreurs[] = "Le prénom est requis.";
    }
    if (empty($nom)) {
        $erreurs[] = "Le nom est requis.";
    }
    if (empty($adresse_mail) || !filter_var($adresse_mail, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse mail est invalide.";
    }
    if (empty($adresse)) {
        $erreurs[] = "L'adresse est requise.";
    }
    if (empty($numero_de_telephone)) {
        $erreurs[] = "Le numéro de téléphone est requis.";
    }

    if (empty($erreurs)) {
        $stmt = $conn->prepare("UPDATE sportif SET nom = ?, prenom = ?, adresse = ?, adresse_mail = ?, numero_de_telephone = ? WHERE id_sportif = ?");
        $stmt->bind_param("sssssi", $nom, $prenom, $adresse, $adresse_mail, $numero_de_telephone, $_SESSION['sportif_id']);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Vos informations ont été mises à jour avec succès !";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour des informations : " . $stmt->error;
        }
        $stmt->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['error_message'] = implode("\n", $erreurs);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . addslashes($_SESSION['success_message']) . "');</script>";
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo "<script>alert('" . addslashes($_SESSION['error_message']) . "');</script>";
    unset($_SESSION['error_message']);
}
?>
