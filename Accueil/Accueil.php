<?php

include('../BDD/connexion.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CoachUs</title>
        <link rel="stylesheet" href="../Accueil/Accueil.css">
    </head>

    <body>
        <div class="top-section">
        <?php include('../PRESENTATION/haut_de_page.php');?>
            <h1> Trouvez <br /> votre Coach </h1>
            <div class="search-container">
    <form action="resultats_recherche.php" method="get">
        <input type="text" name="sport" placeholder="Votre recherche" />
        <button class="search-button" type="submit"> Rechercher </button>
    </form>
</div>


          
            </div>
        </div>
        <br><br>

        <h2 align="center">A propos de nous </h2>
        <div class="enca3">
            <p>CoachUs est une plateforme dédiée à la mise en relation entre sportifs et coachs professionnels. Que vous soyez à la recherche d'un coach pour améliorer vos performances dans un sport spécifique ou que vous souhaitiez bénéficier d'un suivi personnalisé, CoachUs vous offre une solution simple et rapide. Grâce à une interface intuitive, vous pouvez facilement rechercher un coach en fonction de votre discipline sportive, consulter les avis d'autres utilisateurs, et organiser vos séances directement en ligne. Notre objectif est de rendre l'apprentissage et l'entraînement plus accessibles et efficaces pour tous.</p>
        </div>


        <h2 align="center">Avis de nos utilisateurs</h2>
        <div class="enca">
            <?php
            
            $query_reviews = "
                SELECT 
                    sportif.prenom AS sportif_prenom,
                    coach.prenom AS coach_prenom, 
                    coach.nom AS coach_nom, 
                    reservation.note, 
                    reservation.commentaire
                FROM 
                    reservation
                INNER JOIN sportif ON reservation.id_sportif = sportif.id_sportif
                INNER JOIN coach ON reservation.id_coach = coach.id_coach
                WHERE 
                    reservation.commentaire IS NOT NULL
                ORDER BY 
                    reservation.id_reservation DESC
                LIMIT 10
            ";

            $result_reviews = $conn->query($query_reviews);

            if ($result_reviews->num_rows > 0) {
                echo '<div class="user-reviews">';
                while ($row = $result_reviews->fetch_assoc()) {
                    echo '<div class="review">';
                    echo '<p><strong>Coach :</strong> ' . htmlspecialchars($row['coach_prenom']) . " " . htmlspecialchars($row['coach_nom']) . '</p>';
                    echo '<p><strong>Note :</strong> ' . htmlspecialchars($row['note']) . '/5</p>';
                    echo '<p>' . htmlspecialchars($row['commentaire']) . '</p>';
                    echo '<p><strong>Sportif :</strong> ' . htmlspecialchars($row['sportif_prenom']) . '</p>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<p>Aucun avis pour le moment.</p>';
            }
            ?>
        </div>

        <h2 align="center">Apprendre n'a jamais été aussi simple !</h2>
        <div class="flex">
            <div class="encadrer">
                <h2>1. Rechercher</h2>
                <p> Consultez librement les profils des coachs selon vos critères</p>
            </div>
            <div class="encadrer2">
                <h2>2. Contactez</h2>
                <p>Les coachs vous répondent en seulement quelques heures ! Et si vous ne trouvez pas tout de suite le coach idéal, notre équipe sera là pour vous aider</p>
            </div>
            <div class="encadrer3">
                <h2>3. Organisez</h2>
                <p>Echangez et programmez vos séances simplement depuis la messagerie avec votre coach</p>
            </div>
        </div>

        <?php include('../PRESENTATION/bas_de_page.php');?>
    </body>
</html>
