<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coachus";


$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

?>
