<<<<<<< Updated upstream
<<<<<<< Updated upstream
<?php	
$db = new PDO("mysql:host=localhost;dbname=coachus", "root", "");
?>
=======
=======
>>>>>>> Stashed changes
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coachus";

<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

?>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
