<?php
include('../BDD/connexion.php');

// Récupérer les lieux en attente
$query = "SELECT * FROM lieux_temp WHERE statut = 'en_attente'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $locations = [];
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
} else {
    $locations = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si l'action existe avant d'essayer de l'utiliser
    if (isset($_POST['action'])) {
        // Action "Accepter"
        if ($_POST['action'] === 'accepter' && isset($_POST['location-id']) && isset($_POST['location-places']) && isset($_POST['location-latitude']) && isset($_POST['location-longitude'])) {
            $location_id = $_POST['location-id'];
            $location_places = $_POST['location-places'];
            $location_latitude = $_POST['location-latitude'];
            $location_longitude = $_POST['location-longitude'];

            // Insertion des données dans la table 'lieu'
            $insert_query = "INSERT INTO lieu (nom, adresse, nombre_places_disponibles, latitude, longitude) 
                             SELECT nom, adresse, ?, ?, ? FROM lieux_temp WHERE id = ?";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param("dssi", $location_places, $location_latitude, $location_longitude, $location_id);
            
            if ($stmt_insert->execute()) {
                // Mise à jour du statut dans la table 'lieux_temp' à 'accepte'
                $update_query = "UPDATE lieux_temp SET statut = 'accepte' WHERE id = ?";
                $stmt_update = $conn->prepare($update_query);
                $stmt_update->bind_param("i", $location_id);
                $stmt_update->execute();

                echo "<script>alert('Le lieu a été accepté et ajouté dans la base de données.');</script>";
            } else {
                echo "<script>alert('Erreur lors de l\'ajout du lieu dans la base de données.');</script>";
            }

            $stmt_insert->close();
            $stmt_update->close();
        }
        
        // Action "Supprimer"
        if ($_POST['action'] === 'supprimer' && isset($_POST['location-id'])) {
            $location_id = $_POST['location-id'];

            // Supprimer le lieu de la table 'lieux_temp'
            $delete_query = "DELETE FROM lieux_temp WHERE id = ?";
            $stmt_delete = $conn->prepare($delete_query);
            $stmt_delete->bind_param("i", $location_id);
            
            if ($stmt_delete->execute()) {
                echo "<script>alert('Le lieu a été supprimé avec succès.');</script>";
            } else {
                echo "<script>alert('Erreur lors de la suppression du lieu.');</script>";
            }

            $stmt_delete->close();
        }
    }
}

?>