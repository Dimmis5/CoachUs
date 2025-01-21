<?php
include('../BDD/connexion.php');

// Debug: Vérifier si la méthode est bien POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: Vérifier si les données sont envoyées
    if (isset($_POST['location-name']) && isset($_POST['location-address'])) {
        $location_name = $_POST['location-name'];
        $location_address = $_POST['location-address'];

        // Debug: Afficher les valeurs reçues
        echo "Nom du lieu : " . $location_name . "<br>";
        echo "Adresse : " . $location_address . "<br>";

        // Préparer la requête pour insérer les données dans lieux_temp
        $query = "INSERT INTO lieux_temp (nom, adresse, statut) VALUES (?, ?, 'en_attente')";
        $stmt = $conn->prepare($query);

        // Vérifier si la préparation de la requête a échoué
        if ($stmt === false) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }

        $stmt->bind_param("ss", $location_name, $location_address);

        // Exécuter la requête
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
