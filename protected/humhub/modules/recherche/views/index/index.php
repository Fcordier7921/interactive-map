<?php

use yii\helpers\Html;
use myCompany\humhub\modules\recherche\assets\Assets;


Assets::register($this); //lien vers les dépendanse js et css
?>

<!-- cdn de leaflet js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.0.0/dist/esri-leaflet-geocoder.css" integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin="">
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>



<body>
    <h1 class="h1">Trouver la personne dont vous avez besoin.</h1>
    <div class="row">
        <div class="searchc">
            <label>recherche:</label><br>
            <input type="text" class="search" id="search" name="search" />
        </div>
        <!-- <div class="searchc">
            <label>recherche:</label><br>
            <input type="text"  id="search" name="search" />
        </div> -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="list row col-xs-12 col-sm-5 col-lg-7" id="documents">
                <?php foreach ($users as $user) : ?>
                    
                    <div class='document  item js-marker col-xs-12 col-lg-4  ' <?php if ($user->profile->lat != null && $user->profile->lng != null) : ?> data-lat='<?= Html::encode("{$user->profile->lat}") ?>' data-lng='<?= Html::encode("{$user->profile->lng}") ?>' <?php else : ?> data-lat='46.80<?php echo rand(270, 300); ?> ' data-lng='5.45<?php echo rand(170, 200); ?>' <?php endif; ?> data-nom='<?= Html::encode("{$user->profile->firstname} {$user->profile->lastname}") ?>'>

                        <?php if (file_exists("uploads/profile_image/{$user->guid}.jpg")) : ?>
                            <?= Html::img("uploads/profile_image/{$user->guid}.jpg", ['alt' => 'My logo']) ?>
                        <?php else : ?>
                            <?= Html::img("static/img/default_user.jpg", ['alt' => 'My logo']) ?>
                        <?php endif; ?>
                        <h4><?= Html::encode("{$user->profile->firstname} {$user->profile->lastname}") ?> </h4>

                        <div class="display">
                            <h6>Mes compétences: </h6>
                            <p>
                                <?= Html::encode("{$user->tags}") ?>
                            </p>
                            <h6>Contacter moi: </h6>
                            <p>
                                <?= Html::encode("{$user->email}") ?>
                            </p>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
            <!--affichage de la carte-->
            <div class='map col-xs-12 col-lg-5' id="map"></div>


        </div>

    </div>
    
    <script src="https://unpkg.com/@popperjs/core@2"></script>


</body>

</html>