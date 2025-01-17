<?php
if (isset($_GET['creneau'])) {
    $creneau = htmlspecialchars($_GET['creneau']);
} else {
    $creneau = "inconnu";
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
        }
        .container {
            background-color: #FFF;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            font-size: 2.5em;
            color: #28A745;
        }
        p {
            font-size: 1.3em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="color: #F4A940; font-size: 2.5em;">Félicitations !</h1>
        <p>Votre créneau <strong><?php echo $creneau; ?></strong> a été réservé avec succès.</p>
        <p>Merci de votre confiance !</p>
        <p><a href="reservation_creneaux.php">Retour à la page de réservation</a></p>
    </div>
</body>
</html>