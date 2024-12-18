<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #a0baf4, #F2CDAC, white);
            color: #333;
            height: 100vh;
            width: 100%;
        }
        
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(17, 37, 152, 0.1);
        }
        .faq {
            margin: 20px 0;
        }
        .question {
            font-weight: bold;
            margin: 10px 0;
            cursor: pointer;
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .answer {
            display: none;
            margin: 10px 0;
            padding: 10px;
            border-left: 3px solid #007bff;
            background: #eef6ff;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }
        header img {
            height: 40px;
        }
        .top-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .top-links button {
            background-color: white;
            border: 2px solid white;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .top-links button:hover {
            background-color: #007bff;
            color: white;
        }
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .tab {
            margin: 0 10px;
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .tab:hover {
            background-color: #eef6ff;
        }
        .tab.active {
            background-color: #007bff;
            color: white;
        }
        .faq-section {
            display: none;
        }
        .faq-section.active {
            display: block;
        }
        .top-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .toggle-btns {
            display: flex;
            justify-content: center;
            background: #f9f9f9;
            border-radius: 50px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .toggle-btn {
            flex: 1;
            padding: 10px 20px;
            text-align: center;
            font-weight: bold;
            border: none;
            cursor: pointer;
            background-color: white;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }
        .toggle-btn.active {
            background-color: #007bff;
            color: white;
        }
        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }
        .search-bar input {
            padding: 10px;
            width: 50%;
            max-width: 500px;
            border: 2px solid #ccc;
            border-radius: 20px 0 0 20px;
            outline: none;
        }
        .search-bar button {
            padding: 10px 20px;
            border: none;
            background-color: #a0baf4;
            color: #333;
            border-radius: 0 20px 20px 0;
            font-weight: bold;
            cursor: pointer;
        }
        .question-icon {
            width: 35px;
            height: 35px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            cursor: pointer;
            border: 2px solid #007bff;
        }
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .intro-text {
            text-align: center;
            font-size: 1.5rem;
            margin: 20px 0;
            font-weight: bold;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const questions = document.querySelectorAll(".question");
            const toggleBtns = document.querySelectorAll(".toggle-btn");
            const faqSections = document.querySelectorAll(".faq-section");
 
        
            questions.forEach(question => {
                question.addEventListener("click", () => {
                    const answer = question.nextElementSibling;
                    const isVisible = answer.style.display === "block";
                    answer.style.display = isVisible ? "none" : "block";
                });
            });
 
        
            toggleBtns.forEach((tab, index) => {
                tab.addEventListener("click", () => {
                    toggleBtns.forEach(t => t.classList.remove("active"));
                    faqSections.forEach(section => section.classList.remove("active"));
 
                    tab.classList.add("active");
                    faqSections[index].classList.add("active");
                });
            });
 
          
            const activeTab = document.querySelector(".tab.active");
            if (activeTab) {
                const activeIndex = Array.from(tabs).indexOf(activeTab);
                faqSections[activeIndex].classList.add("active");
            }
        });
    </script>
</head>
<body>
    <header>
        <img src="CoachUs Text.png" alt="Logo">
        <div class="top-links">
            <div class="question-icon">?</div>
            <button><a href="connexioncoach.html">JE SUIS COACH</button></a>
            <button><a href="connexionsportif.html">JE VEUX UN COACH</button></a>
        </div>
    </header>
 
    <div class="intro-text">
        De quelle manière pouvons-nous vous accompagner ?
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Rechercher">
        <button>Rechercher</button>
    </div>
</div>
    <div class="container">
        <div class="toggle-btns">
            <button class="toggle-btn active">Sportifs</button>
            <button class="toggle-btn">Coachs</button>
        </div>
 
        <div class="faq-section active">
            <h2>Sportifs</h2>
            <div class="faq">
                <div class="question">Comment trouver un coach&nbsp;?</div>
                <div class="answer">Utilisez la barre de recherche pour filtrer les coachs par sport, localisation, disponibilité et tarif. Vous pouvez également consulter leurs profils pour plus d'informations.</div>
            </div>
            <div class="faq">
                <div class="question">Comment réserver un créneau&nbsp;?</div>
                <div class="answer">Une fois que vous avez trouvé un coach, sélectionnez un créneau horaire disponible sur leur profil, puis confirmez la réservation en remplissant vos informations.</div>
            </div>
            <div class="faq">
                <div class="question">Que faire si je veux annuler ou modifier ma réservation&nbsp;?</div>
                <div class="answer">Vous pouvez annuler ou modifier votre réservation via votre compte, dans la section "Mes Réservations". Assurez-vous d'informer le coach en cas de modification importante.</div>
            </div>
        </div>
 
        <div class="faq-section">
            <h2>Coachs</h2>
            <div class="faq">
                <div class="question">Comment devenir coach sur CoachUs&nbsp;?</div>
                <div class="answer">Pour devenir coach, inscrivez-vous en tant que coach sur notre plateforme, créez votre profil, définissez vos horaires et tarifs, puis attendez que les sportifs vous contactent.</div>
            </div>
            <div class="faq">
                <div class="question">Comment fixer mes tarifs&nbsp;?</div>
                <div class="answer">Les tarifs sont à votre choix, mais nous vous conseillons de tenir compte de votre expérience et du marché local. Vous pouvez ajuster vos prix à tout moment sur votre profil.</div>
            </div>
            <div class="faq">
                <div class="question">Est-ce que CoachUs prend une commission&nbsp;?</div>
                <div class="answer">Oui, CoachUs prend une commission sur chaque réservation effectuée via la plateforme, mais nous vous offrons la possibilité de fixer vos propres tarifs.</div>
            </div>
        </div>
    </div>
</body>
</html>