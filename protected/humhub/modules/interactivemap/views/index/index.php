<?php

use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
\myCompany\humhub\modules\interactivemap\assets\Assets::register($this);

$displayName = (Yii::$app->user->isGuest) ? Yii::t('InteractivemapModule.base', 'Guest') : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("interactivemap", [
    'username' => (Yii::$app->user->isGuest) ? $displayName : Yii::$app->user->getIdentity()->username,
    'text' => [
        'hello' => Yii::t('InteractivemapModule.base', 'Hi there {name}!', ["name" => $displayName])
    ]
])

?>


<head>
    <meta charset="utf-8">
    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
   

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />

    <style type="text/css">
        #map {
            /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
            height: 90vh;
        }

        #searchtext {
            margin-bottom: 1rem;
        }
    </style>
    <title>Carte</title>
</head>

<div class="panel-heading"><strong>Interactivemap</strong> <?= Yii::t('InteractivemapModule.base', 'overview') ?></div>

<div class="panel-body">


    <div class="form-container">
        
            <label>rechercher les info sur les marqueure :</label><br>
            <input type="text" name="textName" id="text">
            
        
    </div>
    <div id="map">
        <!-- Ici s'affichera la carte -->
    </div>

    <!-- Fichiers Javascript -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'>
    </script>
    <script type="text/javascript">
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
    </script>


   