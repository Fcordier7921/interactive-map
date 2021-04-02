
    // On initialise la latitude et la longitude de comenaill (centre de la carte)
    var lat = 46.802722;
    var lon = 5.451833;
    var macarte = null;
    var markerClusters;

       
     // Servira à stocker les groupes de marqueurs
    // Nous initialisons une liste de marqueurs

    var villes = [
        {
            "nom": "Fablab",
            "lat": 46.802722,
            "lon": 5.451833,
            "description": "le meilleur fablab"
        },
        {
            "nom": "Lons le saunier",
            "lat": 46.673367,
            "lon": 5.533428,
            "description": "une ville bien sympa"
        },
        {
            "nom": "Blettrans",
            "lat": 46.746865,
            "lon": 5.457269,
            "description": "c'est tout petit mais il y a tout"
        },
        {
            "nom": "Relans",
            "lat": 46.761987,
            "lon": 5.447907,
            "description": "le trou du q du monde"
        }
    ];
     //recupére les valeur de la recherche
let text = document.getElementById("text");
text.addEventListener('input', (event)=>{
    const valuetext = event.target.value;
    console.log(valuetext);
}) 

    
    var tableauMarquer = [];

    // Fonction d'initialisation de la carte
    function initMap() {
        
        // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
        macarte = L.map('map').setView([lat, lon], 11);
        markerClusters = L.markerClusterGroup(); // Nous initialisons les groupes de marqueurs
        // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            //  le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);
        // Nous parcourons la liste des villes
        for (ville in villes) {

            var marker = L.marker([villes[ville].lat, villes[ville]
            .lon]); // pas de addTo(macarte), l'affichage sera géré par la bibliothèque des clusters
            marker.bindPopup("<h1>" + villes[ville].nom + "</h1><br><p>" + villes[ville].description + "</p>").openPopup();
            markerClusters.addLayer(marker); // Nous ajoutons le marqueur aux groupes

            //on ajoute le marque du tableau
            tableauMarquer.push(marker);
        }
        //on regoupre les marquer
        var groupe = new L.featureGroup(tableauMarquer);
        macarte.fitBounds(groupe.getBounds().pad(0.2)); //rendre visible tout les marqueure

        macarte.addLayer(markerClusters);
    }

    window.onload = function () {
        // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap();
    };
