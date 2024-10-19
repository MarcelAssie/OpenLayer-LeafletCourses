<?php


declare(strict_types=1);
session_start();
require_once 'flight/Flight.php';
// require 'flight/autoload.php';

Flight::route('/', function() {
    Flight::render('accueil');
});

Flight::route('/introduction', function() {
    Flight::render('introduction');
});

Flight::route('/vie_sociale', function() {
    Flight::render('vie_sociale');
});

Flight::route('/vie_professionnel', function() {
    Flight::render('vie_professionnel');
});

Flight::route('/vie_amoureuse', function() {
    Flight::render('vie_amoureuse');
});

Flight::route('/vie_artistique', function() {
    Flight::render('vie_artistique');
});

Flight::route('/galerie', function() {
    Flight::render('galerie');
});

Flight::route('/send_email', function() {
    Flight::render('send_email');
});

Flight::route('/confirmation_email', function() {
    Flight::render('confirmation_email');
});

Flight::route('/departements', function() {
    Flight::render('depts');
});

Flight::route('/game', function() {
    Flight::render('game');
});

Flight::route('/map', function() {
    Flight::render('leaflet');
});

Flight::route('/webmapping', function() {
    Flight::render('openlayer');
});


Flight::route('/today', function () {
    $moisFr = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    $joursFr = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
    $jourAuj = date('d');
    $moisAuj = date('m');
    $anneeAuj = date('Y');
    $moisAujfr = $moisFr[$moisAuj - 1];
    $dateJour = "{$joursFr[date('N') -1]} {$jourAuj} {$moisAujfr} {$anneeAuj}";
    Flight::render('today', ['dateJour' => $dateJour, 'joursFr'=> $joursFr]);
});

Flight::route('GET /login', function() {
    Flight::render('login');
});

Flight::route('/map', function() {
    Flight::render('leaflet');
});



Flight::route('POST /villes', function() {
    $link = mysqli_connect('localhost', 'root', 'root', 'geobase');
    mysqli_set_charset($link, "utf8");

    if (!$link) {
        http_response_code(500);  // Répond avec un code d'erreur HTTP
        Flight::json(['error' => 'Erreur de connexion à la base de données']);
        exit;
    }

    $recherche = $_POST['recherche'];
    $villes = [];

    if (!empty($recherche)) {
        $sql = "SELECT insee, nom FROM communes WHERE nom LIKE '$recherche%' LIMIT 10";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            http_response_code(500);  // Répond avec un code d'erreur HTTP
            Flight::json(['error' => 'Requête échouée']);
            exit;
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $villes[] = $row;
        }
    }

    // Envoi du JSON sans texte supplémentaire
    Flight::json($villes);
});


Flight::route('GET /commune-geometry', function() {
     $link = mysqli_connect('localhost', 'root', 'root', 'geobase');
//    $link = mysqli_connect('u2.ensg.eu', 'geo', '', 'geobase');
    mysqli_set_charset($link, "utf8");

    $geometry = [];

    if (isset($_GET['insee_ville']) && !empty($_GET['insee_ville'])) {
        $insee_ville = $_GET['insee_ville'];

        // Requête SQL pour récupérer la géométrie en GeoJSON
        $sql = "SELECT ST_AsGeoJSON(geometry) AS geom FROM communes WHERE insee = '$insee_ville'";
        $result = mysqli_query($link, $sql);
        $geometry = mysqli_fetch_assoc($result)['geom'];
    }

    // Retourner la géométrie en JSON
    Flight::json(json_decode($geometry));
});


Flight::route('POST /login', function() {
//    $user = $_POST['email'];
//    $password = $_POST['password'];
    $user = Flight::request()->data->email;
    $password = Flight::request()->data->password;
    if (!empty($user) && !empty($password)) {
        $_SESSION["user"] = $user;
        Flight::redirect('/');
    } else {
        $error = 'Veuillez remplir tous les champs.';
        Flight::render('login', ['error' => $error]);
    }
});

Flight::route('/logout', function() {
    session_destroy();
    Flight::redirect('/');
});

?>

<?php Flight::start(); ?>


