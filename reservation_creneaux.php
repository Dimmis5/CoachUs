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
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 800px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .day-section {
            background-color: #FFF7E5;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.8em;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Réservation de Créneaux</h1>

        
        <div class="day-section">
            <h2>Mardi 1 Octobre</h2>
            <?php
                $creneaux = ['07:30', '10:00', '14:00', '15:00', '16:00', '18:00'];
                foreach ($creneaux as $heure) {
                    echo '
                        <form action="reservation.php" method="POST" class="slot-form">
                            <input type="hidden" name="creneau" value="Mardi 1 Octobre - ' . $heure . '">
                            <button type="submit" class="slot">' . $heure . '</button>
                        </form>';
                }
            ?>
        </div>


        <div class="day-section">
            <h2>Mercredi 2 Octobre</h2>
            <?php
                $creneaux = ['07:30', '10:00', '14:00', '15:00', '16:00', '18:00'];
                foreach ($creneaux as $heure) {
                    echo '
                        <form action="reservation.php" method="POST" class="slot-form">
                            <input type="hidden" name="creneau" value="Mercredi 2 Octobre - ' . $heure . '">
                            <button type="submit" class="slot">' . $heure . '</button>
                        </form>';
                }
            ?>
        </div>
    </div>
</body>
</html>