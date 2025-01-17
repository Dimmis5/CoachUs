<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coachus';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['creneau'])) {
    $action = $_POST['action'];
    $creneau = htmlspecialchars($_POST['creneau']);

    if ($action === 'reserve') {
        $stmt = $conn->prepare("INSERT INTO reservations_new (creneau) VALUES (?)");
        if ($stmt) {
            $stmt->bind_param("s", $creneau);
            if ($stmt->execute()) {
                header("Location: confirmation.php?creneau=" . urlencode($creneau));
                exit();
            } else {
                echo "Erreur lors de l'insertion : " . $stmt->error;
            }
            $stmt->close();
        }
    } elseif ($action === 'cancel') {
        $stmt = $conn->prepare("DELETE FROM reservations_new WHERE creneau = ?");
        if ($stmt) {
            $stmt->bind_param("s", $creneau);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$conn->close();

header("Location: reservation_creneaux.php");
exit();
?>