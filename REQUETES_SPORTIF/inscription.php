<?php
session_start();
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
    if (empty($nom)) $erreurs[] = "Le nom est requis.";
    if (empty($prenom)) $erreurs[] = "Le prénom est requis.";
    if (empty($adresse)) $erreurs[] = "L'adresse est requise.";
    if (empty($numero_de_telephone)) $erreurs[] = "Le numéro de téléphone est requis.";
    if (empty($adresse_mail)) $erreurs[] = "L'adresse mail est requise.";
    if (empty($identifiant)) $erreurs[] = "L'identifiant est requis.";
    if (empty($mot_de_passe)) $erreurs[] = "Le mot de passe est requis.";

    if (empty($erreurs)) {
        // Vérifier si l'identifiant existe déjà
        $stmt = $conn->prepare("SELECT * FROM sportif WHERE identifiant = ?");
        $stmt->bind_param("s", $identifiant);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $erreurs[] = "Cet identifiant est déjà utilisé.";
        } else {
            // Hachage du mot de passe
            $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            // Insérer le sportif dans la table `sportif`
            $stmt = $conn->prepare("INSERT INTO sportif (nom, prenom, adresse, numero_de_telephone, adresse_mail, identifiant, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $nom, $prenom, $adresse, $numero_de_telephone, $adresse_mail, $identifiant, $mot_de_passe_hash);

            if ($stmt->execute()) {
                $id_sportif = $conn->insert_id;

                // Ajouter le sportif dans la table `users`
                $pseudo = $prenom . " " . $nom;
                $role = 'sportif';
                $stmtUsers = $conn->prepare("INSERT INTO users (id, pseudo, role, password) VALUES (?, ?, ?, ?)");
                $stmtUsers->bind_param("isss", $id_sportif, $pseudo, $role, $mot_de_passe_hash);

                if ($stmtUsers->execute()) {
                    $_SESSION['sportif_id'] = $id_sportif;
                    header('Location: ../SPORTIF/profil.php');
                    exit();
                } else {
                    $erreurs[] = "Erreur lors de l'ajout dans la table users.";
                }
                $stmtUsers->close();
            } else {
                $erreurs[] = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
            $stmt->close();
        }
    }
}
?>
