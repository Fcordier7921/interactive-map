// traitement de la barre de recherche
document.getElementById('search').addEventListener('keyup', function(e) {
    var recherche = this.value.toLowerCase();
    var documents = document.querySelectorAll('.document');

    Array.prototype.forEach.call(documents, function(document) {


        // On a bien trouvé les termes de recherche.
        if (document.innerHTML.toLowerCase().indexOf(recherche) > 1) {
            document.style.display = 'block';

        } else {
            document.style.display = 'none';
        }

    });
});
//traitemant la carte et des marker 
let $map = document.querySelector('#map'); //selection de la div

class LeafletMap {

    constructor() {
        this.map = null;
        this.bounds = []; //tableau des différent point des marker pour centrer la carte
    }

    async load(element) {
        return new Promise((resolve, reject) => { // on retoune un promesse  pour charger la carte en asychrone en utilisant la librairie scriptjs
            $script('https://unpkg.com/leaflet@1.3.1/dist/leaflet.js', () => { //chargement du cdn de leaflet
                this.map = L.map(element);
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    //  le lien vers la source des données(mension légal)
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1, //definir le zomm mini et maxi
                    maxZoom: 20
                }).addTo(this.map);
                //gestion de l'échelle de la carte
                L.control.scale({
                    metric: true,
                    imperial: false,
                    position: 'topright'
                }).addTo(this.map);
                resolve();
            })
        })
    }
    //création des marker
    addMarker(lat, lng, text) { //text est contien tout les info de la fiche
        let point = [lat, lng];
        this.bounds.push(point);
        return new LeafletMarker(point, text, this.map);
        
        
        
    }

    center() { //centrer la carte parrapport a tout les point
        this.map.fitBounds(this.bounds, {
            padding: [50, 50]
        });
    }
}

class LeafletMarker { //class qui contient la gestion des marker
    constructor(point, text, map) {
        this.text = text;
        this.popup = L.popup({ //création de la popup 
                autoClose: false,
                closeOnEscapeKey: false,
                closeOnClick: false,
                closeButton: false,
                maxWidth: 400
            })
            .setLatLng(point) //position
            .setContent(text) //tesxte dans la marker(nom)
            .openOn(map);
    }

    setActive() {
        this.popup.getElement().classList.add('is-active'); //rajoute une la class is-active pour lors du survole le marker devin bleu

    }
    unsetActive() {
        this.popup.getElement().classList.remove('is-active'); //retirer la classe is-active
    }

    addEventListener(event, cb) {
        this.popup.addEventListener('add', () => {
            this.popup.getElement().addEventListener(event, cb);
        })
    }

    setContent(text) {
        this.popup.setContent(text);
        this.popup.getElement().classList.add('is-expanded');//rajoute une la class iis-expanded pour agrandire la popup et afficher les infos de l'utilisateur
        this.popup.update();
    }
    resetContent() {
        this.popup.setContent(this.text);
        this.popup.getElement().classList.remove('is-expanded');//retirer la classe is-expanded
        this.popup.update();
    }


}

//initialisation de la carte
const initMap = async function() {
    let map = new LeafletMap();
    let hoverMarker = null; //variable pour sauvegarder le marker sur lequelle on est
    let activeMarker = null;
    await map.load($map); //on attend le chargement de la carte
    //par surté on télécharge le polifyle de arrey.from
    
     Array.from(document.querySelectorAll('.js-marker')).forEach((item) => {
        let marker = map.addMarker(item.dataset.lat, item.dataset.lng, item.dataset.nom);
        item.addEventListener('mouseover', () => { //ajouter au survole de la sourie sur la liste a gauche
            if (hoverMarker !== null) { //suprimer le dernier marker actif
                hoverMarker.unsetActive();
            }
            marker.setActive();
            hoverMarker = marker;
        })
        item.addEventListener('mouseleave', () => { //retirer le marker actif
            if (hoverMarker !== null) {
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
        item.addEventListener('click', () => { //au click sur le item afficher du contenue
            if (activeMarker !== null) {
                activeMarker.resetContent();
            }
            marker.setContent(item.innerHTML);
            activeMarker = marker;
        })
        item.addEventListener('mouseleave', () => {// enlever l'affichage du contenu
            if (activeMarker !== null) {
                activeMarker.resetContent();
            }
        })
        console.log(marker);
    })
    
    map.center(); //centre la carte sur le marker

}

if ($map !== null) {
    initMap();

}

