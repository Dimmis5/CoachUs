<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FAQ/FAQ.css">
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
      <div class="logo"></div>
      <div class="header-container">
          <div align="left">
              <img src="../LOGO/LOGO.png" alt="logo" width="50" height="75" />
              <a href="../Accueil/Accueil.html">
                  <img class="logo" src="../LOGO/CoachUs.png" alt="logo" width="250" height="75" />
              </a>
          </div>
          <div align="right" class="button-container">
              <button> <a href="../FAQ/FAQ.html"> ?</a>  </button>
              <button> <a href="../Connexion/connexionsportif.php"> JE VEUX UN COACH </a> </button>
              <button> <a href="../Connexion/connexioncoach.php"> JE SUIS COACH  </a></button>
          </div>
      </div>
 
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

    <footer>
        <div class="footer-container">
          <div class="footer-column">
            <h3>Nos Services</h3>
            <ul>
              <li><a href="#"> Service clientèle </a></li>
              <li><a href="#"> Réglement intérieur </a></li>
              <li><a href="#"> Heure d'ouverture </a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>À propos</h3>
            <ul>
              <li><a href="#"> Notre Histoire </a></li>
              <li><a href="../Mentionslégales/MentionsLégales.html"> Mentions Légales </a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Nos Lieux</h3>
            <ul>
                <li><a href="../Carte/Carte.html"> Aubervilliers </a></li>
                <li><a href="../Carte/Carte.html"> Boulogne-Billancourt </a></li>
                <li><a href="../Carte/Carte.html"> Châtillon </a></li>
                <li><a href="../Carte/Carte.html"> Colombes </a></li>
                <li><a href="../Carte/Carte.html"> Courbevoie </a></li>
                <li><a href="../Carte/Carte.html"> Créteil </a></li>
                <li><a href="../Carte/Carte.html"> Issy-les-Moulineaux </a></li>
                <li><a href="../Carte/Carte.html"> Massy </a></li>
                <li><a href="../Carte/Carte.html"> Meudon </a></li>
                <li><a href="../Carte/Carte.html"> Paris </a></li>
                <li><a href="../Carte/Carte.html"> Versailles </a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Nous Contacter</h3>
            <ul>
              <li> support@coachus.com </li>
              <li><a href="../FAQ/FAQ.html"> FAQ </a></li>
            </ul>
          </div>
        </div>
      
        <div class="footer-bottom">
          <p>&copy; 2024 COACHUS. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>