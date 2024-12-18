<?php

include('../BDD/connexion.php'); 

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $identifiant = trim($_POST['identifiant'] ?? '');
    $mot_de_passe = trim($_POST['mot_de_passe'] ?? '');

    if (empty($identifiant)) {
        $erreurs[] = "L'identifiant est requis.";
    }
    if (empty($mot_de_passe)) {
        $erreurs[] = "Le mot de passe est requis.";
    }

    if (empty($erreurs)) {

        $stmt = $conn->prepare("SELECT mot_de_passe FROM sportif WHERE identifiant = ?");
        $stmt->bind_param("s", $identifiant);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
                    echo "Connexion réussie.";
                } else {
                    echo "Mot de passe incorrect.";
                }
            } else {
                echo "Identifiant non trouvé.";
            }
        } else {
            echo "Erreur lors de la requête : " . $stmt->error;
        }

        $stmt->close();
    } else {
        foreach ($erreurs as $erreur) {
            echo $erreur . "<br>";
        }
    }
}

$conn->close();

?>
