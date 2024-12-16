<<<<<<< Updated upstream
<?php	
$db = new PDO("mysql:host=localhost;dbname=coachus", "root", "");
?>
=======
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coachus";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

?>
>>>>>>> Stashed changes
