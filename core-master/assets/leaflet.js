var map = L.map('map').setView([51.505, -0.09], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var groupMarqueurs = L.layerGroup().addTo(map)

//var marker = L.marker([51.5, -0.09]).addTo(map);
//var circle = L.circle([51.508, -0.11], {
//    color: 'red',
//    fillColor: '#f03',
//    fillOpacity: 0.5,
//    radius: 500
//}).addTo(map);
//
//var polygon = L.polygon([
//    [51.509, -0.08],
//    [51.503, -0.06],
//    [51.51, -0.047]
//]).addTo(map);
//
//marker.bindPopup("<b>Hello world!</b><br>Je suis recherché par Interpol.").openPopup();
//circle.bindPopup("I am a circle.");
//polygon.bindPopup("I am a polygon.");

Vue.createApp({
    data() {
        return {
            text: "",
            nb: 0,
            input: false,
            resultat:[]
        };
    },
    computed: {
        addressesFound() {
            return this.nb > 0;
        }
    },
    methods: {
        getAdresse(){
            this.input = true;
            fetch('http://api-adresse.data.gouv.fr/search/?q='+this.text)
                .then((result) => {
                  return result.json();
                })
                .then((result) => {
                groupMarqueurs.clearLayers(); /*Suppression des marqueurs*/
                const marqueurs = result.features /*Selection des features du GeoJSON*/
                this.nb = marqueurs.length;
                const bounds = []
                for (let i = 0; i < marqueurs.length; i++) {
                    const coordinates = marqueurs[i].geometry.coordinates
                    let lat = coordinates[1]
                    let lon = coordinates[0]
                    bounds.push([lat, lon])
                    var marker = L.marker([lat, lon]).addTo(groupMarqueurs);
                    map.setView([lat, lon], map.getZoom())
                    marker.bindPopup(`<strong>Adresse : </strong> <br> ${marqueurs[i].properties.label}`).openPopup();
                }
                if (bounds.length > 0) {
                    map.fitBounds(bounds)
                }
            })
        },
        getCurrentPosition () {
            navigator.geolocation.getCurrentPosition((position) => {
                let lat = position.coords.latitude
                let lon = position.coords.longitude
                var marker = L.marker([lat, lon]).addTo(map);
                var circle = L.circle([lat, lon], {
                color: 'blue',
                fillColor: 'blue',
                fillOpacity: 0.4,
                radius: position.coords.accuracy
                }).addTo(map);

                map.setView([lat, lon], map.getZoom())

                marker.bindPopup(`<strong>Bonjour!</strong> <br> Vous avez été localisé par Interpol à ${[lat]} et  ${[lon]}`).openPopup();
            });
        },
        saisieUtilisateur() {
            let donnees = new FormData();
            donnees.append('recherche', this.text);

            // Envoi de la requête POST
            fetch('/villes', {
                method: 'POST',
                body: donnees
            })
                .then(response => response.text())
                .then(response => {
                    this.resultat = JSON.parse(response);
                })
                .catch(error => console.error('Erreur:', error));
        },
        localisationCommune(insee_ville) {
            fetch('http://localhost/commune-geometry?insee_ville=' + insee_ville)
                .then(response => response.json())
                .then(data => {
                    groupMarqueurs.clearLayers();
                    var marker = L.marker([data.features[0].geometry.coordinates[1], data.features[0].geometry.coordinates[0]]).addTo(groupMarqueurs)
                    var layer = L.geoJSON(data).addTo(groupMarqueurs);
                    map.fitBounds(layer.getBounds());
                    marker.bindPopup(`<strong>Bonjour!</strong> <br> Vous avez été localisé`).openPopup();
                });
        }
    }

}).mount('#entete');


