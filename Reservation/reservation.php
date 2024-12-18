<?php
// Activer les erreurs pour débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier les données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['creneau'])) {
    $creneau = htmlspecialchars($_POST['creneau']);
} else {
    $creneau = "Aucun créneau sélectionné.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
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
            text-align: center;
        }

        .container {
            background-color: #FFF;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 90%;
        }

        h1 {
            font-size: 2.5em;
            color: #F4A940; /* Couleur exacte comme dans votre image */
            margin-bottom: 20px;
        }

        p {
            font-size: 1.5em;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-size: 1.2em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        a:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Félicitations !</h1>
        <p>Votre créneau <strong><?php echo $creneau; ?></strong> a été réservé avec succès.</p>
        <a href="reservation_creneaux.php">Retour à la page de réservation</a>
    </div>
</body>
</html>