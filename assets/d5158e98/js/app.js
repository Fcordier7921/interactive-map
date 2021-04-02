// traitement de la barre de recherche
document.getElementById('search').addEventListener('keyup', function(e) {
    var recherche = this.value.toLowerCase();
    var documents = document.querySelectorAll('.document');
    
    Array.prototype.forEach.call(documents, function(document) {
        
        
      // On a bien trouvé les termes de recherche.
      if (document.innerHTML.toLowerCase().indexOf(recherche) > -1) {
        document.style.display = 'block';
        
      } else {
        document.style.display = 'none';
      }
      
    });
  });


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
    Array.from(document.querySelectorAll('.js-marker')).forEach((item) => {
        let marker = map.addMarker(item.dataset.lat, item.dataset.lng, item.dataset.nom );
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


