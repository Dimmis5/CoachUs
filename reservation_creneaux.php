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

// Récupérer les créneaux réservés depuis la base de données
$reserved_slots = [];
$result = $conn->query("SELECT creneau FROM reservations_new");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reserved_slots[] = $row['creneau']; // Ajouter les créneaux réservés dans un tableau
    }
}

// Définition des créneaux disponibles
$creneaux_mardi = ['07:30', '10:00', '14:00', '15:00', '16:00', '18:00'];
$creneaux_mercredi = ['07:30', '10:00', '14:00', '15:00', '16:00', '18:00'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Créneaux</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #B8C5D6, #FFDFA7);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h1, h2 {
            margin: 20px 0;
            color: #333;
        }

        .day-section {
            background-color: #FFF7E5;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .slot-form {
            display: inline-block;
            margin: 5px;
        }

        .slot {
            background-color: #FFEDC1;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .slot:hover {
            background-color: #FFD480;
            transform: scale(1.05);
        }

        .slot.reserved {
            background-color: #D3D3D3; /* Gris clair pour les créneaux réservés */
            color: #A0A0A0;
            cursor: not-allowed;
            box-shadow: none; /* Retirer l'ombre pour les créneaux grisés */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="font-size: 2.5em; font-weight: bold; color: #F4A940;">COACH<span style="color: #3C4858;">US</span> </h1>

        <!-- Mardi 1 Octobre -->
        <div class="day-section">
            <h2>Mardi 1 Octobre</h2>
            <?php
            foreach ($creneaux_mardi as $heure) {
                $full_slot = "Mardi 1 Octobre - $heure";
                $is_reserved = in_array($full_slot, $reserved_slots) ? 'reserved' : '';
                echo '
                    <form action="reservation.php" method="POST" class="slot-form">
                        <input type="hidden" name="creneau" value="' . $full_slot . '">
                        <button type="submit" class="slot ' . $is_reserved . '" ' . ($is_reserved ? 'disabled' : '') . '>
                            ' . $heure . '
                        </button>
                    </form>';
            }
            ?>
        </div>

        <!-- Mercredi 2 Octobre -->
        <div class="day-section">
            <h2>Mercredi 2 Octobre</h2>
            <?php
            foreach ($creneaux_mercredi as $heure) {
                $full_slot = "Mercredi 2 Octobre - $heure";
                $is_reserved = in_array($full_slot, $reserved_slots) ? 'reserved' : '';
                echo '
                    <form action="reservation.php" method="POST" class="slot-form">
                        <input type="hidden" name="creneau" value="' . $full_slot . '">
                        <button type="submit" class="slot ' . $is_reserved . '" ' . ($is_reserved ? 'disabled' : '') . '>
                            ' . $heure . '
                        </button>
                    </form>';
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>