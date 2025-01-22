<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats Recherche</title>
    <link rel="stylesheet" href="../Profilducoach/az.css">
    <script>
     
        function showPopupAndRedirect(message, redirectUrl) {
            alert(message);  
            window.location.href = redirectUrl;  
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="contenu-principal">
        <?php
        
        include('../BDD/connexion.php');

        
        $sports_valides = [
            "Football" => 1,
            "Basketball" => 2,
            "Tennis" => 3,
            "Natation" => 4,
            "Rugby" => 5,
            "Handball" => 6,
            "Volleyball" => 7,
            "Badminton" => 8,
            "Cyclisme" => 9,
            "Golf" => 10
        ];

        $recherche = $_GET['sport'] ?? '';

      
        if (array_key_exists($recherche, $sports_valides)) {
            $id_sport = $sports_valides[$recherche];
            

            $query_coachs = "
                SELECT 
                    coach.prenom AS coach_prenom, 
                    coach.nom AS coach_nom,
                    reservation.note AS note,
                    reservation.commentaire AS commentaire
                FROM 
                    coach
                LEFT JOIN reservation ON reservation.id_coach = coach.id_coach
                WHERE 
                    coach.id_sport = $id_sport
            ";

            $result_coachs = $conn->query($query_coachs);

            if ($result_coachs->num_rows > 0) {
                echo "<h1>Coach(s) disponible(s) pour le sport : " . htmlspecialchars($recherche) . "</h1>";
                echo '<div class="coachs-list">';
                while ($row = $result_coachs->fetch_assoc()) {
                    echo '<div class="coach">';
                    echo '<p><strong>' . htmlspecialchars($row['coach_prenom']) . " " . htmlspecialchars($row['coach_nom']) . '</strong></p>';
                    

                    if ($row['note'] !== null) {
                        echo '<p><strong>Note :</strong> ' . htmlspecialchars($row['note']) . '/5</p>';
                    }
                    if ($row['commentaire'] !== null) {
                        echo '<p><strong>Commentaire :</strong> ' . htmlspecialchars($row['commentaire']) . '</p>';
                    }

                    echo '</div>';
                }
                echo '</div>';
            } else {

                echo "<script>showPopupAndRedirect('Aucun coach trouvé pour ce sport.', '../Accueil/Accueil.php');</script>";
            }
        } else {

            $query_lieu = "
                SELECT * FROM lieu
                WHERE nom LIKE '%" . $conn->real_escape_string($recherche) . "%'
            ";
            $result_lieu = $conn->query($query_lieu);

            if ($result_lieu->num_rows > 0) {

                $lieu = $result_lieu->fetch_assoc();
                $nom_lieu = urlencode($lieu['nom']);
                $latitude = $lieu['latitude'];
                $longitude = $lieu['longitude'];
                $adresse = $lieu['adresse']; 
                

                header("Location: ../Carte/carte.php?lieu=$nom_lieu&lat=$latitude&lng=$longitude&adresse=" . urlencode($adresse));
                exit;
            } else {

                echo "<script>showPopupAndRedirect('Aucun lieu ou sport trouvé.', '../Accueil/Accueil.php');</script>";
            }
        }
        ?>
        </div>
    </div>
</body>
</html>
