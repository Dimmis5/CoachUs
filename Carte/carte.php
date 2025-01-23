<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Interactive - Lieux de Sport en Île-de-France</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="../Carte/carte1.css" />
</head>
<body>

<div class="top-section">
            <div class="header-container">
                <div align="left">
                    <img src="../LOGO/LOGO.png" alt="logo" width="50" height="75" />
                    <img src="../LOGO/CoachUS.png" class="logo" alt="logo" width="250" height="70" />
                </div>
                <div align="right" class="button-container">
                    <button><a href="../FAQ/FAQ.php"> ?</a></button>
                    <button><a href="../Connexion/connexionsportif.php">JE VEUX UN COACH </a></button>
                    <button><a href="../Connexion/connexioncoach.php">JE SUIS COACH </a></button>
                </div>
            </div>
    <h1>CARTES DES LIEUX A VOTRE DISPOSITION</h1>
    
    <div id="map"></div>
    <div id="locations"></div>
    
    <button class="add-location-btn" id="add-location-btn">Ajouter un lieu</button>

    <div class="add-location-form" id="add-location-form">
        <h3>Ajouter un nouveau lieu</h3>
        <form id="location-form" method="POST" action="../CARTE/lieu_attente.php">
            <label for="location-name">Nom du lieu:</label><br>
            <input type="text" id="location-name" name="location-name" required><br>
            
            <label for="location-address">Adresse:</label><br>
            <input type="text" id="location-address" name="location-address" required><br>
            
            <button type="submit">Ajouter le lieu</button>
        </form>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const lieuRecherche = urlParams.get('lieu');
        const latitudeRecherche = parseFloat(urlParams.get('lat'));
        const longitudeRecherche = parseFloat(urlParams.get('lng'));
        const adresseLieu = urlParams.get('adresse');  

        var map = L.map('map').setView([48.8566, 2.3522], 10); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

    
        if (lieuRecherche && !isNaN(latitudeRecherche) && !isNaN(longitudeRecherche)) {     
            map.setView([latitudeRecherche, longitudeRecherche], 14);   
            var marker = L.marker([latitudeRecherche, longitudeRecherche]).addTo(map)
                .bindPopup(`<b>${lieuRecherche}</b><br>Adresse: ${adresseLieu}`);

            marker.openPopup();
        }


        fetch('../CARTE/lieux.php')
            .then(response => response.json())
            .then(locations => {
                var locationsContainer = document.getElementById('locations');
                locations.forEach(function(location) {
                
                    var marker = L.marker([location.latitude, location.longitude]).addTo(map)
                        .bindPopup(`<b>${location.nom}</b><br>Adresse: ${location.adresse}<br>Places disponibles: ${location.nombre_places_disponibles}`);

                    
                    var locationDiv = document.createElement('div');
                    locationDiv.className = 'location-item';
                    locationDiv.innerHTML = `
                        <b>${location.nom}</b><br>
                        Adresse: ${location.adresse}<br>
                        <b>Places disponibles:</b> ${location.nombre_places_disponibles}
                    `;
                    locationDiv.onclick = function() {
                        map.setView([location.latitude, location.longitude], 14);
                        marker.openPopup();
                    };
                    locationsContainer.appendChild(locationDiv);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des lieux:', error));
    </script>

<footer>
            <div class="footer-container">
                <div class="footer-column">
                    <h3>Nos Services</h3>
                    <ul>
                        <li><a href="#">Service clientèle</a></li>
                        <li><a href="#">Règlement intérieur</a></li>
                        <li><a href="#">Heure d'ouverture</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>À propos</h3>
                    <ul>
                        <li><a href="#">Notre Histoire</a></li>
                        <li><a href="../Mentionslégales/MentionsLégales.html">Mentions Légales</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Nos Lieux</h3>
                    <ul>
                        <li><a href="../Carte/Carte.php">Aubervilliers</a></li>
                        <li><a href="../Carte/Carte.php">Boulogne-Billancourt</a></li>
                        <li><a href="../Carte/Carte.php">Châtillon</a></li>
                        <li><a href="../Carte/Carte.php">Colombes</a></li>
                        <li><a href="../Carte/Carte.php">Courbevoie</a></li>
                        <li><a href="../Carte/Carte.php">Créteil</a></li>
                        <li><a href="../Carte/Carte.php">Issy-les-Moulineaux</a></li>
                        <li><a href="../Carte/Carte.php">Massy</a></li>
                        <li><a href="../Carte/Carte.php">Meudon</a></li>
                        <li><a href="../Carte/Carte.php">Paris</a></li>
                        <li><a href="../Carte/Carte.php">Versailles</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Nous Contacter</h3>
                    <ul>
                        <li>support@coachus.com</li>
                        <li><a href="../FAQ/FAQ.html">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 COACHUS. Tous droits réservés.</p>
            </div>
        </footer>
</body>
</html>
