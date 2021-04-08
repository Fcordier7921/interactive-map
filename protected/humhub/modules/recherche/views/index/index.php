
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

h1{
    text-align: center;
}
.map{
    margin-top: 800rem;
    position: -webkit-sticky!important;
    position: sticky!important;
    top: 100px;
    right: 0;
    left: 0;
    height: 100vh;
    box-shadow: -2px -2px 7px black;
}

.leaflet-popup{
    margin-bottom: 16px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    padding: 5px 10px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    background-color: white;

}
.leaflet-popup::after{
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
.leaflet-popup-content-wrapper{
    background: transparent!important;
    color: inherit!important;
    box-shadow: none!important;
    text-align: inherit!important;
}
.leaflet-popup-tip-container{
    display: none;
}
.leaflet-popup-content{
    text-align: inherit;
    color: inherit;
    margin: 0!important;
}
.is-active , .leaflet-popup:hover{
    background-color: #506ff5!important;
    z-index: 300;
    color: #fff;
}
.is-active::after, .leaflet-popup:hover::after{
    border-top-color: #506ff5;
}
.is-expanded, .is-expanded:hover  {
    background-color: #fff!important;
    color: inherit!important;
    z-index: 350;
    text-align: center;
}
.img{
    width: 200px;
    height: 210px;
}
@media screen and (max-width: 1025px) {
    #map{
        display: none;
    }
    .list{
        min-width: 100vw;
    }
  }
    </style>
    
    

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
        
    
    

<body>
    <h1 class="m-5">Trouver la personne dont vous avez besoin</h1>    
        <label class="mx-5">recherche:</label><br>
        <input type="text" class="search mx-5 mb-5" id="search" name="search"  />
    
    <div class="container-fluid">
            <div class="row">
                <div class="list row col-12 col-lg-9 col-xl-7 m-0" id="documents">
                    <?php foreach ($users as $user): ?>

                        <div class='document  item js-marker col-12 col-md-3 my-2 mx-4 w-5' data-city='<?= Html::encode("{$user->profile->street} {$user->profile->zip} {$user->profile->city}") ?>'  data-nom='<?= Html::encode("{$user->profile->firstname} {$user->profile->lastname}") ?>'>
                            
                            <?= Html::img("uploads/profile_image/{$user->guid}.jpg", ['alt' => 'My logo'])?>
                            <h4 class="mb-3"><?= Html::encode("{$user->profile->firstname} {$user->profile->lastname}") ?>  </h4>
                            
                                
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
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
<script>/*!
  * $script.js JS loader & dependency manager
  * https://github.com/ded/script.js
  * (c) Dustin Diaz 2014 | License MIT
  */
(function(e,t){typeof module!="undefined"&&module.exports?module.exports=t():typeof define=="function"&&define.amd?define(t):this[e]=t()})("$script",function(){function p(e,t){for(var n=0,i=e.length;n<i;++n)if(!t(e[n]))return r;return 1}function d(e,t){p(e,function(e){return t(e),1})}function v(e,t,n){function g(e){return e.call?e():u[e]}function y(){if(!--h){u[o]=1,s&&s();for(var e in f)p(e.split("|"),g)&&!d(f[e],g)&&(f[e]=[])}}e=e[i]?e:[e];var r=t&&t.call,s=r?t:n,o=r?e.join(""):t,h=e.length;return setTimeout(function(){d(e,function t(e,n){if(e===null)return y();!n&&!/^https?:\/\//.test(e)&&c&&(e=e.indexOf(".js")===-1?c+e+".js":c+e);if(l[e])return o&&(a[o]=1),l[e]==2?y():setTimeout(function(){t(e,!0)},0);l[e]=1,o&&(a[o]=1),m(e,y)})},0),v}function m(n,r){var i=e.createElement("script"),u;i.onload=i.onerror=i[o]=function(){if(i[s]&&!/^c|loade/.test(i[s])||u)return;i.onload=i[o]=null,u=1,l[n]=2,r()},i.async=1,i.src=h?n+(n.indexOf("?")===-1?"?":"&")+h:n,t.insertBefore(i,t.lastChild)}var e=document,t=e.getElementsByTagName("head")[0],n="string",r=!1,i="push",s="readyState",o="onreadystatechange",u={},a={},f={},l={},c,h;return v.get=m,v.order=function(e,t,n){(function r(i){i=e.shift(),e.length?v(i,r):v(i,t,n)})()},v.path=function(e){c=e},v.urlArgs=function(e){h=e},v.ready=function(e,t,n){e=e[i]?e:[e];var r=[];return!d(e,function(e){u[e]||r[i](e)})&&p(e,function(e){return u[e]})?t():!function(e){f[e]=f[e]||[],f[e][i](t),n&&n(r)}(e.join("|")),v},v.done=function(e){v([null],e)},v})

/**
 * Array.from() polyfill
 */
// From https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/from
// Production steps of ECMA-262, Edition 6, 22.1.2.1
if (!Array.from) {
	Array.from = (function () {
		var toStr = Object.prototype.toString;
		var isCallable = function (fn) {
			return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
		};
		var toInteger = function (value) {
			var number = Number(value);
			if (isNaN(number)) { return 0; }
			if (number === 0 || !isFinite(number)) { return number; }
			return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
		};
		var maxSafeInteger = Math.pow(2, 53) - 1;
		var toLength = function (value) {
			var len = toInteger(value);
			return Math.min(Math.max(len, 0), maxSafeInteger);
		};

		// The length property of the from method is 1.
		return function from(arrayLike/*, mapFn, thisArg */) {
			// 1. Let C be the this value.
			var C = this;

			// 2. Let items be ToObject(arrayLike).
			var items = Object(arrayLike);

			// 3. ReturnIfAbrupt(items).
			if (arrayLike == null) {
				throw new TypeError('Array.from requires an array-like object - not null or undefined');
			}

			// 4. If mapfn is undefined, then let mapping be false.
			var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
			var T;
			if (typeof mapFn !== 'undefined') {
				// 5. else
				// 5. a If IsCallable(mapfn) is false, throw a TypeError exception.
				if (!isCallable(mapFn)) {
					throw new TypeError('Array.from: when provided, the second argument must be a function');
				}

				// 5. b. If thisArg was supplied, let T be thisArg; else let T be undefined.
				if (arguments.length > 2) {
					T = arguments[2];
				}
			}

			// 10. Let lenValue be Get(items, "length").
			// 11. Let len be ToLength(lenValue).
			var len = toLength(items.length);

			// 13. If IsConstructor(C) is true, then
			// 13. a. Let A be the result of calling the [[Construct]] internal method
			// of C with an argument list containing the single item len.
			// 14. a. Else, Let A be ArrayCreate(len).
			var A = isCallable(C) ? Object(new C(len)) : new Array(len);

			// 16. Let k be 0.
			var k = 0;
			// 17. Repeat, while k < len… (also steps a - h)
			var kValue;
			while (k < len) {
				kValue = items[k];
				if (mapFn) {
					A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
				} else {
					A[k] = kValue;
				}
				k += 1;
			}
			// 18. Let putStatus be Put(A, "length", len, true).
			A.length = len;
			// 20. Return A.
			return A;
		};
	}());
}
</script>





<script>


 //traitemant la carte et des marker 
let $map = document.querySelector('#map');

class LeafletMap{

    constructor (){
        this.map= null;
        this.bounds=[];
    }

    async load (element){
        return new Promise((resolve, reject)=>{
            $script('https://unpkg.com/leaflet@1.3.1/dist/leaflet.js', ()=>{
                this.map=L.map(element);
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    //  le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(this.map);
                resolve();
            })
        })  
    }

    addMarker(lat, lng, text){
        let point =[lat, lng];
        this.bounds.push(point);
        return  new LeafletMarker(point, text, this.map);
    }

    center(){
        this.map.fitBounds(this.bounds);
    }

}
class LeafletMarker{
    constructor(point, text, map){
            this.text=text;
            this.popup=L.popup({
                autoClose: false,
                closeOnEscapeKey: false,
                closeOnClick:false,
                closeButton: false,
                
                maxWidth: 400
            })
            .setLatLng(point)
            .setContent(text)
            .openOn(map);
    }

    setActive(){
        this.popup.getElement().classList.add('is-active');

    }
    unsetActive(){
        this.popup.getElement().classList.remove('is-active');
    }

    addEventListener(event, cb){
        this.popup.addEventListener('add', ()=>{
            this.popup.getElement().addEventListener(event, cb);
        })
    }
    
    setContent(text){
        this.popup.setContent(text);
        this.popup.getElement().classList.add('is-expanded');
        this.popup.update();
    }
    resetContent(){
        this.popup.setContent(this.text);
        this.popup.getElement().classList.remove('is-expanded');
        this.popup.update();
    }
   
}
 
const initMap= async function(){
    let map= new LeafletMap();
    let hoverMarker=null;
    let activeMarker= null;
    
    await map.load($map);

    Array.from(document.querySelectorAll('.js-marker')).forEach((item)  => {
  
        let city =item.dataset.city;
        var lat= 46.802819;
        var long= 5.451600;
        var callBackGetSuccess =  function (data) {
            console.log("donnees api", data);
            lat= data.results[0].locations[0].latLng.lat;
            long= data.results[0].locations[0].latLng.lng;
            console.log(lat);
        }
        let url = "http://open.mapquestapi.com/geocoding/v1/address?key=p7SEPkMy7u1mNlD7jnfoU3KtcLKmdlco&location= "+city;

        $.get(url, callBackGetSuccess).done(function () {

        }).fail(function () {
            alert("error");
        })
        .always(function () {

        });

        console.log("latitude out de la fonction", lat);

        let marker = map.addMarker(lat, long, item.dataset.nom );
        item.addEventListener('mouseover', function(){
            if(hoverMarker !== null){
                hoverMarker.unsetActive();
            }
            marker.setActive();
            hoverMarker= marker;
        })
        item.addEventListener('mouseleave', function(){
            if(hoverMarker !== null){
                hoverMarker.unsetActive();
            }
        })
        marker.addEventListener('click', function(){
            if(activeMarker !== null){
                activeMarker.resetContent();
            }
            marker.setContent(item.innerHTML);
            activeMarker= marker;
        })
        marker.addEventListener('mouseleave', function(){
            if(activeMarker !== null){
                activeMarker.resetContent();
            }
        })
        
        
    })
    map.center();
    
}
if($map !==null){
    initMap();
    
}


</script>
</body>
</html>