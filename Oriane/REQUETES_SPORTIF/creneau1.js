function details(buttonElement) {
    const idDisponibilite = buttonElement.getAttribute('data-id');
    const date = buttonElement.getAttribute('data-date');
    const heuredebut = buttonElement.getAttribute('data-heuredebut');
    const heurefin = buttonElement.getAttribute('data-heurefin');
    const coachnom = buttonElement.getAttribute('data-coachnom');
    const coachprenom = buttonElement.getAttribute('data-coachprenom');
    const sport = buttonElement.getAttribute('data-sport');
    const lieu = buttonElement.getAttribute('data-lieu');
    const idcoach = buttonElement.getAttribute('data-idcoach');
    const idsport = buttonElement.getAttribute('data-idsport');
    const idlieu = buttonElement.getAttribute('data-idlieu');
    const idsportif = buttonElement.getAttribute('data-idsportif');

    // Message de confirmation
    const message = `Vous avez sélectionné le créneau suivant : \n\n`
        + `Date : ${date}\n`
        + `De : ${heuredebut}\n`
        + `A : ${heurefin}\n`
        + `Pour le sport : ${sport}\n`
        + `Avec : ${coachnom} ${coachprenom}\n`
        + `Dans le lieu : ${lieu}\n`
        + `Confirmez-vous ce choix ?`;

    if (window.confirm(message)) {
        console.log("Confirmation reçue pour ID :", idDisponibilite);

        // Créer un objet FormData pour envoyer les données comme un formulaire classique
        const formData = new FormData();
        formData.append('id_disponibilite', idDisponibilite);
        formData.append('id_sport', idsport);
        formData.append('id_coach', idcoach);
        formData.append('id_lieu', idlieu);
        formData.append('id_sportif', idsportif);


        // Envoyer les données via fetch
        fetch('../REQUETES_SPORTIF/reservation.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // Récupérer la réponse texte
        .then(data => {
            if (data.includes('success')) {
                alert("Réservation réussie !");
            } else {
                alert("Une erreur est survenue lors de la réservation : " + data);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur est survenue. Veuillez réessayer.");
        });
    } else {
        console.log("L'utilisateur a annulé.");
    }
}
