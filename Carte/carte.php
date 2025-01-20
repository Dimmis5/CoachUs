<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Interactive - Lieux de Sport en Île-de-France</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="carte.css" />
</head>
<body>
    <h1>CARTES DES LIEUX A VOTRE DISPOSITION</h1>
    
    <div id="map"></div>
    <div id="locations"></div>
    
    <button class="add-location-btn" id="add-location-btn">Ajouter un lieu</button>

    <div class="add-location-form" id="add-location-form">
        <h3>Ajouter un nouveau lieu</h3>
        <form id="location-form">
            <label for="location-name">Nom du lieu:</label><br>
            <input type="text" id="location-name" name="location-name" required><br>
            
            <label for="location-address">Adresse:</label><br>
            <input type="text" id="location-address" name="location-address" required><br>
            
            <button type="submit">Ajouter le lieu</button>
        </form>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.getElementById('add-location-btn').addEventListener('click', function() {
            var form = document.getElementById('add-location-form');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        });

        fetch('../CARTE/lieux.php')
            .then(response => response.json())
            .then(locations => {
                var map = L.map('map').setView([48.8566, 2.3522], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

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

        document.getElementById('location-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var name = document.getElementById('location-name').value;
            var address = document.getElementById('location-address').value;

            fetch('../CARTE/ajoutLieux.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `nom=${encodeURIComponent(name)}&adresse=${encodeURIComponent(address)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Lieu ajouté avec succès');
                    location.reload();
                } else {
                    alert('Erreur lors de l\'ajout du lieu');
                }
            })
            .catch(error => {
                console.error('Erreur lors de l\'ajout du lieu:', error);
            });
        });
    </script>
</body>
</html>
