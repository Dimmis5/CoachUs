<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENSEIGNER UN CRENEAU</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
include('connexion.php');

$sql = "SELECT id_lieu, nom FROM lieu";
$result = $conn->query($sql);

if (!$result) {
    die("Erreur lors de l'exécution de la requête SQL : " . $conn->error);
}
?>

<body>
    <div class="header-container">
        <h1 align="left"> COACHUS </h1>
        <div align="right" class="button-container">
            <button> <a href="FAQ.html"> ? </a> </button>
            <button> <a href="connexionsportif.html"> JE VEUX UN COACH </a> </button>
            <button> <a href="connexioncoach.html"> JE SUIS COACH </a> </button>
            <button> <a href="accueil.html"> ACCUEIL </a> </button>
        </div>
    </div>

    <div class="container">
        <div class="encadrer">
            <h1> RENSEIGNER VOS DISPONIBILITES </h1>
            <form method="post" action="requete_renseignercreneau.php">

                <div class="form-group">
                    <label for="id_coach">id_coach :</label>
                    <input type="text" id="id_coach" name="id_coach" required>
                </div>
                
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" required>
                </div>
                
                <div class="form-group">
                    <label for="heure_debut">Heure de début :</label>
                    <input type="time" id="heure_debut" name="heure_debut" required>
                </div>
                
                <div class="form-group">
                    <label for="heure_fin">Heure de fin :</label>
                    <input type="time" id="heure_fin" name="heure_fin" required>
                </div>
                
                <div class="form-group">
                    <label for="lieu">Sélectionnez un lieu :</label>
                    <select name="id_lieu" id="id_lieu" style="width: 600px;">
                        <option value="" disabled selected> Sélectionner un lieu </option>
                        <?php
                        $sql = "SELECT id_lieu, nom FROM lieu";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $color = 'black';
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id_lieu'] . '" style="color: ' . $color . ';">' . htmlspecialchars($row['nom']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <button type="submit"> AJOUTER LE CRENEAU </button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
