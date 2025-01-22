<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../BDD/connexion.php');

    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT id_sportif, mot_de_passe FROM sportif WHERE identifiant = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $identifiant);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            $_SESSION['sportif_id'] = $row['id_sportif'];
            
            header('Location: ../SPORTIF/profil.php');
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
    }
}
?>