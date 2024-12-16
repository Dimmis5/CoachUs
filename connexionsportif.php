<!DOCTYPE html>
<html>  
    <head>
        <title> Connexion du coach </title>
        <link rel="stylesheet" href="connexion.css">
    </head>

    <?php
    if (!empty($erreurs)) {
        echo "<ul>";
        foreach ($erreurs as $erreur) {
            echo "<li>" . $erreur . "</li>";
        }
        echo "</ul>";
    }
?>
    <body>
        <div class="header-container">
            <h1 align="left"> COACHUS </h1>
            <div align="right" class="button-container">
                <button> <a href="FAQ.html"> ? </a> </button>
                <button> <a href="connexionsportif.html"> JE VEUX UN COACH </a> </button>
                <button> <a href="connexioncoach.html"> JE SUIS COACH </a> </button>
            </div>
        </div>
        <p> </p>
        <div class='container'>
            <div class="encadrer">
               <h1>Salut : je suis un caca</h1>
                
            </div>
            <form method="POST" action="requete_connexionsportif.php">
                <div class="encadrer">
                    <h1 align="center"> CONNEXION </h1>
                    <div class="search-container">
                        <input type="text" name="identifiant" placeholder="IDENTIFIANT"/>
                    </div>
                    <div class="search-container">
                        <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                    </div><br>
                    <button><a> CONNEXION </a></button>
                    <div class="rectangle">
                        <div class="cercle"> 
                            <span> OU </span>
                        </div>
                    </div>
                    <button><a href="inscriptionsportif.php">INSCRIPTION  </a> </button>
                </div>
            </form>
        </div>
    </body>
</html>