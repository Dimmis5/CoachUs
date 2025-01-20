<?php
include('../BDD/connexion.php');

$sql = "SELECT nom, adresse, nombre_places_disponibles, longitude, latitude FROM lieu";
$result = $conn->query($sql);

$locations = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = [
            'nom' => $row['nom'],
            'adresse' => $row['adresse'],
            'nombre_places_disponibles' => $row['nombre_places_disponibles'],
            'longitude' => (float)$row['longitude'],
            'latitude' => (float)$row['latitude']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($locations);
?>
