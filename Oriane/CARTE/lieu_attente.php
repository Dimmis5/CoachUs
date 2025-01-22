<?php
include('../BDD/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['location-name']) && isset($_POST['location-address'])) {
        $location_name = $_POST['location-name'];
        $location_address = $_POST['location-address'];

        $query = "INSERT INTO lieux_temp (nom, adresse, statut) VALUES (?, ?, 'en_attente')";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }

        $stmt->bind_param("ss", $location_name, $location_address);

        if ($stmt->execute()) {
            echo "Lieu ajouté avec succès!";
        } else {
            echo "Erreur lors de l'ajout du lieu : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Les données du formulaire ne sont pas envoyées correctement.";
    }
} else {
    echo "Le formulaire n'a pas été soumis avec la méthode POST.";
}
?>
