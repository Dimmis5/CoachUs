<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coachus';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$reserved_slots = [];
$result = $conn->query("SELECT creneau FROM reservations_new");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reserved_slots[] = $row['creneau'];
    }
}

$creneaux = ['07:30', '10:00', '14:00', '15:00', '16:00', '18:00'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>COACHUS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to bottom, #B8C5D6, #FFDFA7);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #FFF;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 900px;
            width: 90%;
        }

        h1 {
            font-size: 2.5em;
            font-weight: bold;
            color: #F4A940;
        }

        h1 span {
            color: #3C4858;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .day-section {
            background-color: #FFF7E5;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .slot-form {
            display: inline-block;
            margin: 5px;
            position: relative;
        }

        .slot {
            background-color: #FFEDC1;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .slot:hover {
            transform: scale(1.05);
        }

        .slot.reserved {
            background-color: #D3D3D3;
            color: #A0A0A0;
            cursor: not-allowed;
        }

        .cancel-button {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #FF6B6B;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .slot-form:hover .cancel-button {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>COACH<span>US</span></h1>

        <!-- Mardi 1 Octobre -->
        <div class="day-section">
            <h2>Mardi 1 Octobre</h2>
            <?php
            foreach ($creneaux as $heure) {
                $full_slot = "Mardi 1 Octobre - $heure";
                if (in_array($full_slot, $reserved_slots)) {
                    echo '
                        <form method="POST" action="reservation.php" class="slot-form">
                            <input type="hidden" name="action" value="cancel">
                            <input type="hidden" name="creneau" value="' . $full_slot . '">
                            <button type="button" class="slot reserved" disabled>' . $heure . '</button>
                            <button type="submit" class="cancel-button">Annuler</button>
                        </form>';
                } else {
                    echo '
                        <form method="POST" action="reservation.php" class="slot-form">
                            <input type="hidden" name="action" value="reserve">
                            <input type="hidden" name="creneau" value="' . $full_slot . '">
                            <button type="submit" class="slot">' . $heure . '</button>
                        </form>';
                }
            }
            ?>
        </div>

        <!-- Mercredi 2 Octobre -->
        <div class="day-section">
            <h2>Mercredi 2 Octobre</h2>
            <?php
            foreach ($creneaux as $heure) {
                $full_slot = "Mercredi 2 Octobre - $heure";
                if (in_array($full_slot, $reserved_slots)) {
                    echo '
                        <form method="POST" action="reservation.php" class="slot-form">
                            <input type="hidden" name="action" value="cancel">
                            <input type="hidden" name="creneau" value="' . $full_slot . '">
                            <button type="button" class="slot reserved" disabled>' . $heure . '</button>
                            <button type="submit" class="cancel-button">Annuler</button>
                        </form>';
                } else {
                    echo '
                        <form method="POST" action="reservation.php" class="slot-form">
                            <input type="hidden" name="action" value="reserve">
                            <input type="hidden" name="creneau" value="' . $full_slot . '">
                            <button type="submit" class="slot">' . $heure . '</button>
                        </form>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>