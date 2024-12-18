<?php
// Connexion à la base de données
$host = 'localhost';
$user = 'root'; 
$password = ''; 
$database = 'coachus';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérification et insertion du créneau
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['creneau'])) {
    $creneau = htmlspecialchars($_POST['creneau']);

    $stmt = $conn->prepare("INSERT INTO reservations_new (creneau) VALUES (?)");
    if ($stmt) {
        $stmt->bind_param("s", $creneau);
        if ($stmt->execute()) {
            header("Location: confirmation.php?creneau=" . urlencode($creneau));
            exit();
        } else {
            echo "Erreur d'insertion : " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "Aucun créneau sélectionné.";
}

$conn->close();
?>