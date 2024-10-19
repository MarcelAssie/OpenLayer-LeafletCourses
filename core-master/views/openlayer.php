<?php require_once "logintest.php"?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon_io/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon_io/favicon-16x16.png">
    <title>WikiMarcel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/accueil.css">
    <link rel="stylesheet" href="assets/today.css">
    <link rel="stylesheet" href="assets/style_openlayer.css">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- Librairie OpenLayers -->
    <link rel="stylesheet" href="https://unpkg.com/ol/ol.css">
    <script src="https://unpkg.com/ol/dist/ol.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg" style="background: #2d3e50;">
        <div class="container-fluid">
            <a href="/"><img src="assets/images/logo.png" alt="Logo du site" class="logo"></a>
            <div ="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#contact-us">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="today">Today</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="game">Jeux</a>
                </li>
            <li class="nav-item active">
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
    <div id="results">
        <h2>Rechercher un cours d'eau partout en France en juste un clic😀</h2>
        <div>
            <p v-if="topooh"><strong>{{topooh}}</strong></p>
            <p v-else>Veuillez sélectionner un cours d'eau.</p>
        </div>
    </div>
    <div id="openlayer" ></div>

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
 <script src="assets/openlayer.js"></script>

</body>
</html>