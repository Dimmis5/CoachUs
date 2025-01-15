<?php
include('../BDD/connexion.php'); 

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $adresse = trim($_POST['adresse']);
    $numero_de_telephone = trim($_POST['numero_de_telephone']);
    $adresse_mail = trim($_POST['adresse_mail']);
    $identifiant = trim($_POST['identifiant']);
    $mot_de_passe = trim($_POST['mot_de_passe']);
    
    // Validation des champs
    if (empty($nom)) {
        $erreurs[] = "Le nom est requis.";
    }
    if (empty($prenom)) {
        $erreurs[] = "Le prénom est requis.";
    }
    if (empty($adresse)) {
        $erreurs[] = "L'adresse est requise.";
    }
    if (empty($numero_de_telephone)) {
        $erreurs[] = "Le numéro de téléphone est requis.";
    }
    if (empty($adresse_mail)) {
        $erreurs[] = "L'adresse mail est requise.";
    }
    if (empty($identifiant)) {
        $erreurs[] = "L'identifiant est requis.";
    }
    if (empty($mot_de_passe)) {
        $erreurs[] = "Le mot de passe est requis.";
    }

    if (empty($erreurs)) {
        // Hachage du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insérer le sportif dans la table `sportif`
        $stmt = $conn->prepare("INSERT INTO sportif (nom, prenom, adresse, numero_de_telephone, adresse_mail, identifiant, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nom, $prenom, $adresse, $numero_de_telephone, $adresse_mail, $identifiant, $mot_de_passe_hash);

        if ($stmt->execute()) {
            // Récupérer l'ID du sportif nouvellement ajouté
            $sportifId = $conn->insert_id;

            // Insérer le sportif dans la table `users`
            $pseudo = $prenom . " " . $nom;
            $role = 'sportif';
            $stmtUsers = $conn->prepare("INSERT INTO users (id, pseudo, role, password) VALUES (?, ?, ?, ?)");
            $stmtUsers->bind_param("isss", $sportifId, $pseudo, $role, $mot_de_passe_hash);

            if ($stmtUsers->execute()) {
                echo "Inscription réussie et ajout dans la table users.";
            } else {
                echo "Erreur lors de l'ajout dans la table users: " . $stmtUsers->error;
            }

            $stmtUsers->close();
        } else {
            echo "Erreur lors de l'inscription: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
