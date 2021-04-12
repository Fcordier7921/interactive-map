<?php

use yii\helpers\Html;
use yii\base\BootstrapInterface;
use yii\widgets\LinkPager;
use yii\bootstrap;
use backend\assets\AppAssets;
use humhub\assets\AppAsset;

AppAsset::register($this);
?>
<style>
    h1 {
        text-align: center;
    }

    .map {
        margin-top: 800rem;
        position: -webkit-sticky !important;
        position: sticky !important;
        top: 100px;
        right: 0;
        left: 0;
        height: 100vh;
        box-shadow: -2px -2px 7px black;
    }

    .leaflet-popup {
        margin-bottom: 16px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        padding: 5px 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        background-color: white;

    }

    .leaflet-popup::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        width: 0;
        height: 0;
        margin-left: -8px;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid white;
    }

    .leaflet-popup-content-wrapper {
        background: transparent !important;
        color: inherit !important;
        box-shadow: none !important;
        text-align: inherit !important;
    }

    .leaflet-popup-tip-container {
        display: none;
    }

    .leaflet-popup-content {
        text-align: inherit;
        color: inherit;
        margin: 0 !important;
    }

    .is-active,
    .leaflet-popup:hover {
        background-color: #506ff5 !important;
        z-index: 300;
        color: #fff;
    }

    .is-active::after,
    .leaflet-popup:hover::after {
        border-top-color: #506ff5;
    }

    .is-expanded,
    .is-expanded:hover {
        background-color: #fff !important;
        color: inherit !important;
        z-index: 350;
        text-align: center;
    }

    .img {
        width: 200px;
        height: 210px;
    }

    .document {
        max-height: 20rem;
    }

    .document img {
        width: 140px;
        height: 150px;
    }

    @media screen and (max-width: 1025px) {
        #map {
            display: none;
        }

        .list {
            min-width: 100vw;
        }

        .document {
            max-height: 40rem;
        }
    }
</style>




<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />




<body>
    <h1 class="m-5">Trouver la personne dont vous avez besoin</h1>
    <label class="mx-5">recherche:</label><br>
    <input type="text" class="search mx-5 mb-5" id="search" name="search" />

    <div class="container-fluid">
        <div class="row">
            <div class="list row col-12 col-lg-9 col-xl-7 m-0" id="documents">
                <?php foreach ($users as $user) : ?>

                    <div class='document  item js-marker col-12 col-md-3 mx-4 ' data-city='<?= Html::encode("{$user->profile->street} {$user->profile->zip} {$user->profile->city}") ?>' data-nom='<?= Html::encode("{$user->profile->firstname} {$user->profile->lastname}") ?>'>
                        <?php if (file_exists("uploads/profile_image/{$user->guid}.jpg")) : ?>
                            <?= Html::img("uploads/profile_image/{$user->guid}.jpg", ['alt' => 'My logo']) ?>
                        <?php else : ?>
                            <?= Html::img("static/img/default_user.jpg", ['alt' => 'My logo']) ?>
                        <?php endif; ?>
                        <h4 class="mb-3"><?= Html::encode("{$user->profile->firstname} {$user->profile->lastname}") ?> </h4>


                        <h6>Mes compétences: </h6>
                        <p>
                            <?= Html::encode("{$user->tags}") ?>
                        </p>

                    </div>
                <?php endforeach; ?>
            </div>

            <div class='map col-12 col-md-5 m-0' id="map"></div>


        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var mymap = L.map('map').setView([46.802819, 5.451600], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            //  le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(mymap);

        document.querySelectorAll('.js-marker').forEach((item) => {

            let city = item.dataset.city;
            let url = "http://open.mapquestapi.com/geocoding/v1/address?key=p7SEPkMy7u1mNlD7jnfoU3KtcLKmdlco&location= " + city;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    lat = data.results[0].locations[0].latLng.lat;
                    long = data.results[0].locations[0].latLng.lng;
                    var marker = L.marker([lat, long]).addTo(mymap);
                    marker.bindPopup(item.dataset.nom).openPopup();
                    // let marker = map.addMarker(lat, long, item.dataset.nom);
                    item.addEventListener('mouseover', function() {
                        // if (hoverMarker !== null) {
                        //     hoverMarker.unsetActive();
                        // }
                        // marker.setActive();
                        // hoverMarker = marker;
                    })
                    item.addEventListener('mouseleave', function() {
                        // if (hoverMarker !== null) {
                        //     hoverMarker.unsetActive();
                        // }
                    })
                    marker.addEventListener('click', function() {
                        // if (activeMarker !== null) {
                        //     activeMarker.resetContent();
                        // }
                        // marker.setContent(item.innerHTML);
                        // activeMarker = marker;
                    })
                    marker.addEventListener('mouseleave', function() {
                        // if (activeMarker !== null) {
                        //     activeMarker.resetContent();
                        // }
                    })
                })


        })
     
    </script>

</body>

</html>