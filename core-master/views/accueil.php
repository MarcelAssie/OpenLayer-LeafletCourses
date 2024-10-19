<?php require_once "logintest.php"?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon_io/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
    <title>WikiMarcel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/accueil.css">
    <link rel="stylesheet" href="assets/today.css">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Faster+One&display=swap" rel="stylesheet">

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg" style="background: #2d3e50;">
        <div class="container-fluid">
            <a href="/"><img src="assets/images/logo.png" alt="Logo du site" class="logo"></a>
            <div ="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact-us">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="today">Today</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="game">Jeux</a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="map">Carte</a>
                </li>
            </ul>
        </div>
            <form class="search" role="search">
                    <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                </form>
        <?php if($loginTest) {
            echo "<div class='logout'>
                <p>Connecté en tant que {$_SESSION["user"]}</p>
                <a href='logout' class='btn btn-danger'><i class='fas fa-sign-out-alt'></i></a>

                 </div>";
        }else {
            echo
                "<div>
                    <a href='login' class='login'>Se connecter</a>
                </div>";
        }
        ?>
    </nav>
</header>
<main>
    <section class="title">
        <img src="assets/images/logo.png" alt="Logo de WikiMarcel">
        <h1>WikiMarcel</h1>
        <p><strong>La page web perso de Marcel Assie pour créer des mini Wikipedia pour ses amis</strong></p>
    </section>
    <section class="about zoomIn">
        <h2>Bienvenue sur WikiMarcel</h2>
        <hr>
        <p><strong>WikiMarcel</strong> est le site où Marcel rédige des mini Wikipedia personnalisés pour ses amis. Ici, chaque ami a sa page dédiée pour raconter son histoire avec une touche d'humour et de fun !</p>
    </section>

    <section class="clients">
        <h2>Liste des pages WikiMarcel rédigées</h2>
        <?php if ($loginTest) {
            echo '<ul>
            <li><a href="introduction">
                    <img src="assets/images/gaelle3.jpg" alt="Gaëlle la mystérieuse"> Gaëlle la mystérieuse de l\'île Exploding Kittens
            </a></li>
                    <li><a href="#">
                            <img src="assets/images/joueur.png" alt="Fofana le mathématicien"> Fofana le mathématicien des temps modernes
            </a></li>
            <li><a href="#">
                    <img src="assets/images/joueur.png" alt="Romain le conquérant"> Romain le conquérant de l\'empire de la mort
                </a></li>
            <li><a href="#">
                    <img src="assets/images/joueur.png" alt="Vivien l\'aventurier"> Yohan l\'aventurier du royaume de Zelda
                </a></li>

            <li><a href="#">
    <img src="assets/images/joueur.png" alt="Yohan le conquérant">Vivien les muscles de Vertigéo
    </a></li>
        </ul>';
        }else{
            echo '<p class="connexion-require">Connectez-vous pour voir les pages WikiMarcel</p>';
        }
    ?>

    </section>
<section>
    <div id="app">
        <form @submit.prevent="tweet">
            <textarea v-model="text" placeholder="Veuillez entrer quelque chose..."></textarea>
            <br>
            <p>Il vous reste {{nombreRestant}} caractères</p>
            <p v-if="nombreLimit" style="color: red;">Vous avez depassé la limites de caractères</p>
            <button :disabled="nombreLimit">Tweet</button>
            <input id="photo" type="checkbox" v-model="photo">
            <label for="photo">{{photo? "✓ Photo ajoutée" : "Pas de photo"}}</label>
            <div v-for="element in tweets" id="userMessage">
                <p><strong>{{ element.text }}</strong></p>
                <img v-if="element.photo" src="https://picsum.photos/200/200?random=2">
            <div>
        </form>
    </div>
    </section>


    <section class="contact" id="contact-us">
        <div class="formulaire">
            <h2>Contactez-moi</h2>
            <p>Voulez-vous avoir votre page WikiMarcel ?  Laissez nous un petit message !</p>
            <form action="/send_email" method="POST">
                <div class="mb-3 informations">
                    <div class="name">
                        <input type="text" id="name" name="name" placeholder="Votre nom et prénom" required>
                    </div>
                    <div class="email">
                        <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
                    </div>
                </div>
                <div class="mb-3 message">
                    <textarea id="message" name="message" placeholder="Maximum 200 caractères" maxlength="200" rows="8" required></textarea>
                </div>
                <button type="submit" class="btn btn-success button">Envoyer</button>
            </form>
        </div>
    </section>
</main>

<footer class=" text-center text-lg-start mt-auto pied-de-page" style="background: #2d3e50;">
        <a href="/"><img src="assets/images/logo.png" alt="Logo du site" class="logo"></a>
        <p> © MarcelWiki <?php echo date('Y')?> - Tous droits réservés.</p>
        <div class="liens">
            <a href="https://www.facebook.com/"><img src="assets/images/facebook.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/"><img src="assets/images/instagram.png" alt="Instagram"></a>
        </div>
</footer>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script src="assets/coordinates.js"></script>
</body>
</html>